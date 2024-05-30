<?php
namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_ConsultaRes;
use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRegistro;
use DateTime;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class ReMain extends ConfigDb implements ICat_ConsultaRes {
    public $table;
    public $rowVal;
    public $logic;

    public function getAll() {
        $condicion = empty($this->rowVal) ? " " : $this->generate($this->rowVal);
        $sql = "SELECT * FROM {$this->table} {$condicion};";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);
    }

    private function generate(array $rowval): string {
        $stringSql = "WHERE ";
        $index = 1;
        foreach ($rowval as $key => $value) {
            $arrPrincipal = $value;
            foreach ($arrPrincipal as $idValor) {
                if ($index == count($arrPrincipal)) {
                    $stringSql .= " {$key} = :{$key}_{$index}";
                } else {
                    $stringSql .= " {$key} = :{$key}_{$index} {$this->logic}";
                }
                $index++;
            }
        }
        return $stringSql;
    }

    public function set_modelRes(MRegistro $Registro): bool {
        try {
            // Iniciar transacción
            parent::beginTransaction();

            // Verificar si el usuario ya existe
            if ($this->checkUsuarioExists($Registro->Usuario)) {
                throw new Exception("El usuario ya existe.");
            }

            $sql = "CALL InsertUsuario(?, ?, ?, ?, ?, ?, ?, b?, ?)";

            $dateNow = new DateTime();
            $stmt = parent::prepare($sql);

            $hashedPassword = password_hash($Registro->Password, PASSWORD_BCRYPT);
            $stmt->bindValue(1, $Registro->Usuario);
            $stmt->bindValue(2, $Registro->Nombre);
            $stmt->bindValue(3, $Registro->ApellP);
            $stmt->bindValue(4, $dateNow->format("Y-m-d H:i"));
            $stmt->bindValue(5, $hashedPassword);
            $stmt->bindValue(6, $_SESSION["id_usuario"]);
            $stmt->bindValue(7, $Registro->idRol);
            $stmt->bindValue(8, $Registro->Estatus);
            $stmt->bindValue(9, $Registro->Correo);

            $stmt->execute();

            // Enviar correo electrónico con las credenciales
            $this->enviarCredencialesPorCorreo($Registro->Usuario, $Registro->Password, $Registro->Correo);

            // Confirmar la transacción
            parent::commit();
        } catch (Exception $ex) {
            // Revertir la transacción en caso de error
            parent::rollBack();
            throw new Exception("Error al insertar registro: " . $ex->getMessage());
        }
        return true;
    }

    private function checkUsuarioExists($usuario): bool {
        $sql = "CALL CheckUsuarioExists(?)";
        $stmt = parent::prepare($sql);
        $stmt->bindValue(1, $usuario);
        $stmt->execute();
        $result = $stmt->fetch(parent::FETCH_ASSOC);

        return $result['user_count'] > 0;
    }

    private function enviarCredencialesPorCorreo($usuario, $contrasena, $correoDestinatario) {
        try {
            $mail = new PHPMailer(true);

            // Configuración del servidor SMTP
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ssstssst103@gmail.com'; // Tu dirección de correo electrónico
            $mail->Password   = 'maip xkcr pexe gynf'; // Tu contraseña de correo electrónico
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // Dirección de correo electrónico del remitente y destinatario
            $mail->setFrom('ssstssst103@gmail.com', 'Sistema de Seguridad y Salud en el Trabajo (SSST)');
            $mail->addAddress($correoDestinatario);

            // Contenido del correo electrónico
            $mail->isHTML(true);
            $mail->Subject = 'Credenciales de Acceso';
            $mail->Body    = 'Usuario: ' . $usuario . '<br>Contraseña: ' . $contrasena;

            // Envío del correo electrónico
            $mail->send();
        } catch (Exception $e) {
            throw new Exception("No se pudo enviar el correo electrónico. Error: {$mail->ErrorInfo}");
        }
    }

    public function put_modelRes(MRegistro $model): bool {
        return true;
    }
}
?>