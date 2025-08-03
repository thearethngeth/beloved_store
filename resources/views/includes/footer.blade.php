<style>
    .footer {
        background: linear-gradient(135deg, var(--beloved-primary, #eb8abc) 0%, var(--beloved-dark, #d67aa8) 100%);
        color: white;
        margin-top: 5rem;
        padding-bottom: 100px; /* Space for bottom navigation */
    }

    .footer-content {
        padding: 3rem 0 2rem 0;
    }

    .footer h5 {
        color: white;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .footer h5::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--beloved-accent, #fce9c2);
    }

    .footer ul {
        list-style: none;
        padding: 0;
    }

    .footer ul li {
        margin-bottom: 0.8rem;
    }

    .footer ul li a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .footer ul li a:hover {
        color: white;
        padding-left: 5px;
    }

    .social-icons a {
        display: inline-block;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        margin-right: 10px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        background-color: white;
        color: var(--beloved-primary, #eb8abc);
        transform: translateY(-3px);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        padding: 1.5rem 0;
        text-align: center;
        background-color: rgba(0, 0, 0, 0.1);
    }

    .footer-bottom p {
        margin: 0;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }

    .newsletter-form {
        margin-top: 1rem;
    }

    .newsletter-form .input-group {
        border-radius: 25px;
        overflow: hidden;
    }

    .newsletter-form .form-control {
        border: none;
        padding: 0.8rem 1.2rem;
        border-radius: 25px 0 0 25px;
    }

    .newsletter-form .btn {
        background-color: var(--beloved-accent, #fce9c2);
        color: var(--beloved-primary, #eb8abc);
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 0 25px 25px 0;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .newsletter-form .btn:hover {
        background-color: white;
        transform: translateX(-2px);
    }

    @media (max-width: 768px) {
        .footer-content {
            text-align: center;
        }

        .footer h5::after {
            left: 50%;
            transform: translateX(-50%);
        }
    }
</style>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="row">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>✨ Beloved Skincare</h5>
                    <p class="mb-3" style="color: rgba(255, 255, 255, 0.8); line-height: 1.6;">
                        Discover your skin's true potential with our carefully curated collection of premium skincare products. Natural ingredients, proven results.
                    </p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=61554730449026" title="Facebook">📘</a>
                        <a href="#" title="Instagram">📷</a>
                        <a href="#" title="Twitter">🐦</a>
                        <a href="#" title="YouTube">📺</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Categories</h5>
                    <ul>
                        <li><a href="#">Cleansers</a></li>
                        <li><a href="#">Moisturizers</a></li>
                        <li><a href="#">Serums</a></li>
                        <li><a href="#">Sunscreen</a></li>
                        <li><a href="#">Anti-Aging</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Stay Beautiful</h5>
                    <p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 1rem;">
                        Subscribe to get skincare tips and exclusive offers!
                    </p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                            <button class="btn" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>&copy; 2024 Beloved Skincare. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-0">
                        <a href="#" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; margin-right: 1rem;">Privacy Policy</a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.8); text-decoration: none;">Terms of Service</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
