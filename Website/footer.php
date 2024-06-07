<!-- footer section start -->
<footer class="py-5">
        <div class="row container mx-auto pt">
            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h4>About Us</h4>
                <p class="pt-3">THE TOY MART of India, located on D-11,12,13-Greater Aagam Complex, is a family run, local, independent toy store where FUN is top priority. We hand pick all our toys from the highest quality manufacturers in the toy business, offering a wide selection of educational and challenging toys to entertain young minds as well as the "old fashioned" toys that we grew up with to entertain the minds of everyone young at heart.</p>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h4 class="pb-2">Category</h4>
                <ul class="text-uppercase list-unstyled">
                    <?php
                    foreach($cat_arr as $list){
                        ?>
                        <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h4 class="pb-2">Contact Us</h4>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>123 Street Name, City, India</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>123-456-7890</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <a style="color: white; font-size: 14px; text-decoration: none;" href="mailto:toymart2022@gmail.com">toymart2022@gmail.com</a>
                </div>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h4 class="pb-2">Instagram</h4>
                <div class="row">
                    <img class="img-fluid w-25 h-100 m-2" src="image/owl/blog-1.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="image/owl/blog-3.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="image/owl/blog-5.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="image/owl/blog-4.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="image/owl/blog-2.jpg" alt="">
                </div>
            </div>

            <div class="copyright mt-5">
                <div class="row container mx-auto">
                    <div class="col-lg-4 col-md-6 col-12 text-nowrap mb-2">
                        <p>© Copyright @ 2022 By Toy Mart</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=100079627935624"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://instagram.com/toymart22?utm_medium=copy_link"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="mailto:toymart2022@gmail.com"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                    </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section ends -->


    <script src="plugins/js/bootstrap.min.js"></script>
    <script src="plugins/js/jquery.js"></script>

    <!-- owlcarousel js -->
    <script src="plugins/owlcarousel/owl.carousel.min.js"></script>

    <!-- customjs -->
    <script src="js/custom.js"></script>

</body>

</html>