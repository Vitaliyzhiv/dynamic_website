    <!-- footer -->
    <div class="footer container-fluid">
        <div class="footer-content container">
            <div class="row">

                <div class="footer-section about col-md-4 col-12">
                    <h3 class="logo-text">
                        Мой Блог
                    </h3>
                    <p>
                        Мы являемся блогом о развитии и совершенствовании веб-технологий и дизайна. Наша цель - помочь вам стать лучше, чем вы есть сами.
                    </p>
                    <div class="contact">
                        <!--  Телефон -->
                        <span><i class="fas fa-phone"></i> +1 234 567 890</span>
                        <!-- Почта -->
                        <span><i class="fas fa-envelope"></i> 0K5Zf@example.com</span>
                    </div>
                    <div class="socials">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- section links -->
                <div class="footer-section links col-md-4 col-12">
                    <h3> Ccылки </h3>
                    <br>
                    <ul>
                        <a href="#">
                            <li>События</li>
                        </a>
                        <a href="#">
                            <li>Сообщества</li>
                        </a>
                        <!-- Галерея -->
                        <a href="#">
                            <li>Галерея</li>
                        </a>
                        <a href="#">
                            <li>Контакты</li>
                        </a>
                        <a href="#">
                            <li>О нас</li>
                        </a>
                    </ul>
                </div>

                <!-- section contact-form -->
                <div class="footer-section contact-form col-md-4 col-12">
                    <h3>Связаться с нами</h3>
                    <br>
                    <form action="index.php" method="post">
                        <input type="email" name="email" class="text-input contact-input" placeholder="Ваш email...">
                        <textarea rows="4" name="message" class="text-input contact-input" placeholder="Ваше сообщение..."></textarea>
                        <button type="submit" class="btn btn-big contact-btn">
                            <i class="far fa-paper-plane"></i>
                            Отправить
                        </button>
                    </form>
                </div>

            </div>

            <!-- footer bottom -->
            <div class="footer-bottom">
                copyright &copy; Blog Vitaliyzhiv
            </div>
        </div>
    </div>
    <!-- footer  end-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="<?= BASE_URL . 'assets/js/script.js'  ?>"></script>
    </body>

    </html>