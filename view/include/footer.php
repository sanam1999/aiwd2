</main>
</body>
<footer>
    <div class="back">
        <p>Back to top</p>
    </div>
    <div class="fut">
        <div class="f1">
            <h5 class="bold">Explore</h5>
            <a href=""> <i class="fa-solid fa-house"></i> Home</a>
            <a href=""> <i class="fa-solid fa-truck-fast"></i> Ordes</a>
            <a href=""> <i class="fa-brands fa-sellsy"></i> Sels</a>
            <a href=""><i class="fa-solid fa-heart"></i> Your favourite</a>
            <a href=""><i class="fa-solid fa-user"></i> Profile</a>
            <a href=""><i class="fa-solid fa-right-to-bracket"></i> Sing Up</a>
            <a href=""> <i class="fa-solid fa-right-from-bracket"></i> Login</a>      
        </div>
    
        <div class="f1">
            <h5 class="bold">Follow Us</h5>
            <a href="https://web.facebook.com/?_rdc=1&_rdr">  <i class="fa-brands fa-facebook"></i>  Facebook</a>
            <a href=""> <i class="fa-brands fa-twitter"></i>  Twitter</a>
            <a href=""> <i class="fa-brands fa-linkedin"></i>  Linkedin</a>
            <a href=""> <i class="fa-brands fa-square-instagram"></i>  Instagram</a>
            <a href=""> <i class="fa-brands fa-pinterest"></i>  Pinterest</a>
            <a href=""> <i class="fa-brands fa-github"></i>  Github</a>
        </div>
<div class="f2">
    <form  action="../../route.php" method="post">
         <input type="hidden" name="action" value="feedback">
        <label for="">system feedback</label>
        <textarea name="comments" cols="50" rows="10" placeholder="Write Your feedback"></textarea>
        <button type="submit">Submit</button>
    </form>
        </div>
    </div>
    <div class="l-nav">
        <div class="logo2">
        </div>
        <div class="sec1">
            <div class="eng-i s1"> <i class="fa-solid fa-globe"></i>
                <p> English</p>
            </div>
            <div class="dolr s1">
                <p> $ UDS-U.S. Dollor</p>
            </div>
            <div class="flg s1">
                <p>United States</p>
            </div>
        </div>
    </div>
    <div class="last">
        <p>
        <pre>Conditions of Use   Privacy Notice  Your Ads Privacy Choices
         Â©️ 1996-2023, Amazon.com, Inc. or its affiliates</pre>
        </p>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.querySelector('.oc');
        const body = document.querySelector('main');
        const toggleButton = document.querySelector('.toggleButton');
        toggleButton.addEventListener('click', function () {
            if (sidebar.style.left === '-250px') {
                sidebar.style.left = '0';
                body.style.marginLeft = '250px';
            } else {
                sidebar.style.left = '-250px';
                body.style.marginLeft = '0';
            }
        });
    });
</script>
</body>

</html>