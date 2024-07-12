<?php
namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_ConsultaRes;
use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRegistro;
use DateTime;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PDO;

class ReMain extends ConfigDb implements ICat_ConsultaRes {
    public $table;
    public $rowVal;
    public $logic;

    public function getRol(){
        $condicion = empty($this->rowVal) ? " WHERE estatus = 1" : "{$this->generate($this->rowVal)} AND estatus = 1";
        $sql = "SELECT * FROM {$this->table} {$condicion};";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function getAll() {
        $condicion = empty($this->rowVal) ? "" : $this->generate($this->rowVal);
        $sql = "SELECT * FROM {$this->table} {$condicion};";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArea(){
        $condicion = empty($this->rowVal) ? "" : $this->generate($this->rowVal);
        $sql = "SELECT * FROM {$this->table} {$condicion};";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
    }

    public function getSubArea(){
        $condicion = empty($this->rowVal) ? "" : $this->generate($this->rowVal);
        $sql = "SELECT * FROM {$this->table} {$condicion};";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }

    private function generate(array $rowval): string {
        $stringSql = "WHERE ";
        $index = 1;
        foreach ($rowval as $key => $value) {
            $arrPrincipal = $value;
            foreach ($arrPrincipal as $idValor) {
                $stringSql .= " {$key} = :{$key}_{$index}";
                if ($index < count($arrPrincipal)) {
                    $stringSql .= " {$this->logic}";
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

            if($this->checkUsuarioExists($Registro->Usuario)) { 
                throw new Exception("El usuario ya existe.");
            }
    
            // Verificar que SubArea sea un arreglo
            if (!is_array($Registro->SubArea)) {
                throw new Exception("El campo SubArea debe ser un arreglo.");
            }
    
            // Validar que las subáreas existan antes de insertar
            foreach ($Registro->SubArea as $subArea) {
                $sqlValidacion = "SELECT COUNT(*) AS count FROM cat_sub_areas WHERE id_subarea = ?";
                $stmtValidacion = parent::prepare($sqlValidacion);
                $stmtValidacion->bindValue(1, $subArea);
                $stmtValidacion->execute();
                $resultValidacion = $stmtValidacion->fetch(PDO::FETCH_ASSOC);
    
                if ($resultValidacion['count'] == 0) {
                    throw new Exception("La subárea con ID {$subArea} no existe.");
                }
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
            $stmt->bindValue(6, $_SESSION["id_usuario"]); // Asegúrate de tener $_SESSION["id_usuario"] definida
            $stmt->bindValue(7, $Registro->idRol);
            $stmt->bindValue(8, $Registro->Estatus);
            $stmt->bindValue(9, $Registro->Correo);
    
            $stmt->execute();
    
            // Obtener el ID del usuario insertado
            $result = $stmt->fetch(parent::FETCH_ASSOC);
            $userId = $result['user_id'];
    
            $stmt->closeCursor();
    
            if (!$userId) {
                throw new Exception("No se pudo obtener el ID del usuario insertado.");
            }
    
            // Insertar las subáreas asociadas al usuario en la tabla cat_sub_areas
            $sql2 = "CALL InsertSubUser(?,?)";
            $stmt2 = parent::prepare($sql2);
    
            foreach ($Registro->SubArea as $subArea) {
                $stmt2->bindValue(1, $userId);
                $stmt2->bindValue(2, $subArea);
                $stmt2->execute();
                $stmt2->closeCursor();
            }
    
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
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

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
            $mail->Username   = 's3v4s51@gmail.com'; // Tu dirección de correo electrónico
            $mail->Password   = 'sdip ptxu sxlz oosh'; // Tu contraseña de correo electrónico
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // Dirección de correo electrónico del remitente y destinatario
            $mail->setFrom('s3v4s51@gmail.com', 'Mailer');
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