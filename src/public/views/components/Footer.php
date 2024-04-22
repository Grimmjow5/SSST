 
 
 
</div>
<style>
ul{
    list-style: none;
}
a{
    text-decoration: none;

}
</style>
 <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.3/dist/js/bootstrap.bundle.min.js"></script>-->

    <script>
        const btn = document.getElementById('toggle');
        const slide = document.getElementById('slide');
        btn.addEventListener('click',()=>{
            slide.classList.toggle('d-none');
        });
    </script>
  </body>
  
</html>