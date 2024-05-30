</div>
<style>
ul{
    list-style: none;
}
a{
    text-decoration: none;

}
</style>
<script src="src/public/js/popper.min.js" crossorigin="anonymous"></script>
<script src="src/public/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    

<script src="src/public/js/bootstrap.bundle.min.js"></script>
<script src="src/public/js/datatables.min.js"></script>


  <script src="src/public/js/sweetalert.min.js"></script>
    <script>
        const btn = document.getElementById('toggle');
        const slide = document.getElementById('slide');
        btn.addEventListener('click',()=>{
            slide.classList.toggle('d-none');
        });
    </script>
  </body>
  
</html>