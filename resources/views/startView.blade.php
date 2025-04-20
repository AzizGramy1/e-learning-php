<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Dark Template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --dark-color: #2d3436;
            --darker-color: #1e272e;
            --light-color: #dfe6e9;
            --accent-color: #00cec9;
            --text-color: #f5f6fa;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }


        .hero {
    height: 100vh;
    display: flex;
    align-items: center;
    padding: 0 5%;
    background: 
        linear-gradient(to right, rgba(30, 39, 46, 0.9), rgba(45, 52, 54, 0.7)),
        url('https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1528&q=80') no-repeat center center/cover;
    position: relative;
    overflow: hidden;
}

.hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(108, 92, 231, 0.1) 0%, transparent 70%);
    animation: pulse 15s infinite alternate;
    z-index: 0;
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--darker-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Header Styles */
        header {
            background-color: var(--dark-color);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            z-index: 1000;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 0.5rem;
            color: var(--accent-color);
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a:hover {
            color: var(--accent-color);
        }

        .dark-mode-toggle {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.2rem;
            cursor: pointer;
            margin-left: 2rem;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 5%;
            background: linear-gradient(135deg, var(--darker-color) 0%, var(--dark-color) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(108, 92, 231, 0.1) 0%, transparent 70%);
            animation: pulse 15s infinite alternate;
            z-index: 0;
        }

        @keyframes pulse {
            0% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(25%, 25%);
            }
            100% {
                transform: translate(0, 0);
            }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            line-height: 1.2;
            animation: fadeInUp 1s ease;
        }

        .hero h1 span {
            color: var(--primary-color);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.3s forwards;
            opacity: 0;
        }

        .cta-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease 0.6s forwards;
            opacity: 0;
            position: relative;
            overflow: hidden;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.6);
        }

        .cta-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .cta-button:hover::after {
            transform: translateX(100%);
        }

        /* Courses Section */
        .section {
            padding: 5rem 5%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title h2 {
            font-size: 2.5rem;
            display: inline-block;
            position: relative;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--accent-color);
        }

        /* Image Slider */
        .slider-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease;
            height: 400px;
        }

        .slide {
            min-width: 100%;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            padding: 2rem;
            color: white;
        }

        .slide-content h3 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .slide-content p {
            opacity: 0.9;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            padding: 0 1rem;
            z-index: 10;
        }

        .slider-nav button {
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .slider-nav button:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .slider-dots button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: none;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dots button.active {
            background-color: var(--accent-color);
            transform: scale(1.2);
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background-color: var(--dark-color);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Stats Section */
        .stats {
            background-color: var(--dark-color);
            padding: 4rem 0;
            text-align: center;
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-item {
            padding: 1rem 2rem;
            margin: 1rem;
            position: relative;
        }

        .stat-item::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 50%;
            width: 1px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .stat-item:last-child::after {
            display: none;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.8;
        }

        /* Testimonials */
        .testimonials {
            background-color: var(--darker-color);
            padding: 5rem 0;
        }

        .testimonial-slider {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .testimonial {
            background-color: var(--dark-color);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin: 0 1rem;
            text-align: center;
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.5s ease;
            position: absolute;
            width: 100%;
        }

        .testimonial.active {
            opacity: 1;
            transform: scale(1);
            position: relative;
        }

        .testimonial-content {
            font-style: italic;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .testimonial-content::before,
        .testimonial-content::after {
            content: '"';
            font-size: 3rem;
            color: var(--primary-color);
            opacity: 0.3;
            position: absolute;
        }

        .testimonial-content::before {
            top: -20px;
            left: -10px;
        }

        .testimonial-content::after {
            bottom: -40px;
            right: -10px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
            border: 3px solid var(--primary-color);
        }

        .author-info h4 {
            font-size: 1.2rem;
            margin-bottom: 0.2rem;
        }

        .author-info p {
            opacity: 0.7;
            font-size: 0.9rem;
        }

        .testimonial-nav {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 10px;
        }

        .testimonial-nav button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: none;
            background-color: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .testimonial-nav button.active {
            background-color: var(--accent-color);
            transform: scale(1.2);
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            padding: 3rem 5%;
            margin-top: 3rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: var(--accent-color);
            position: relative;
            display: inline-block;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50%;
            height: 2px;
            background-color: var(--primary-color);
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 0.8rem;
        }

        .footer-column ul li a {
            color: var(--text-color);
            text-decoration: none;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .footer-column ul li a:hover {
            opacity: 1;
            color: var(--accent-color);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--darker-color);
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.7;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .nav-links {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 70px);
                background-color: var(--dark-color);
                flex-direction: column;
                align-items: center;
                padding-top: 2rem;
                transition: left 0.3s ease;
            }

            .nav-links.active {
                left: 0;
            }

            .nav-links li {
                margin: 1rem 0;
            }

            .hamburger {
                display: block;
                cursor: pointer;
                font-size: 1.5rem;
            }

            .stat-item::after {
                display: none;
            }

            .stat-item {
                width: 100%;
                text-align: center;
            }
        }

        /* Hamburger menu (hidden by default) */
        .hamburger {
            display: none;
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="logo"><i class="fas fa-graduation-cap"></i>EduDark</a>
        
        <button class="hamburger">
            <i class="fas fa-bars"></i>
        </button>
        
        <ul class="nav-links">
            <li><a href="#">Accueil</a></li>
            <li><a href="#courses">Cours</a></li>
            <li><a href="#features">Fonctionnalités</a></li>
            <li><a href="#testimonials">Témoignages</a></li>
            <li><a href="#contact">Contact</a></li>
            <li>
                <button class="dark-mode-toggle" id="darkModeToggle">
                    <i class="fas fa-moon"></i>
                </button>
            </li>
        </ul>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Apprenez sans limites avec <span>EduDark</span></h1>
            <p>Découvrez notre plateforme d'e-learning innovante avec des cours de qualité, des enseignants experts et une communauté bienveillante.</p>
            <a href="#" class="cta-button">Commencer maintenant</a>
        </div>
    </section>

    <section class="section" id="courses">
        <div class="section-title">
            <h2>Nos Cours Populaires</h2>
        </div>
        
        <div class="slider-container">
            <div class="slider" id="slider">
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" alt="Cours de programmation">
                    <div class="slide-content">
                        <h3>Développement Web Fullstack</h3>
                        <p>Maîtrisez HTML, CSS, JavaScript et les frameworks modernes pour créer des applications web complètes.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Cours de data science">
                    <div class="slide-content">
                        <h3>Science des Données Avancée</h3>
                        <p>Apprenez le machine learning, l'analyse de données et la visualisation avec Python et R.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Cours de marketing digital">
                    <div class="slide-content">
                        <h3>Marketing Digital Complet</h3>
                        <p>Découvrez les stratégies de SEO, réseaux sociaux, email marketing et publicité en ligne.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80" alt="Cours de business intelligence">
                    <div class="slide-content">
                        <h3>Business Intelligence</h3>
                        <p>Transformez les données en insights stratégiques pour prendre des décisions éclairées.</p>
                    </div>
                </div>
            </div>
            
            <div class="slider-nav">
                <button id="prevSlide"><i class="fas fa-chevron-left"></i></button>
                <button id="nextSlide"><i class="fas fa-chevron-right"></i></button>
            </div>
            
            <div class="slider-dots" id="sliderDots"></div>
        </div>
    </section>

    <section class="section stats">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number" id="studentsCount">0</div>
                <div class="stat-label">Étudiants</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="coursesCount">0</div>
                <div class="stat-label">Cours</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="instructorsCount">0</div>
                <div class="stat-label">Instructeurs</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="countriesCount">0</div>
                <div class="stat-label">Pays</div>
            </div>
        </div>
    </section>

    <section class="section" id="features">
        <div class="section-title">
            <h2>Pourquoi Nous Choisir</h2>
        </div>
        
        <div class="features">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3>Contenu de Qualité</h3>
                <p>Nos cours sont créés par des experts et régulièrement mis à jour pour suivre les dernières tendances technologiques.</p>
            </div>
            
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Mentors Experts</h3>
                <p>Accédez à des mentors expérimentés qui vous guideront tout au long de votre parcours d'apprentissage.</p>
            </div>
            
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3>Certifications</h3>
                <p>Obtenez des certifications reconnues par l'industrie qui valoriseront votre CV et votre profil professionnel.</p>
            </div>
            
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3>Communauté Active</h3>
                <p>Rejoignez une communauté dynamique d'apprenants pour échanger, collaborer et progresser ensemble.</p>
            </div>
            
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Apprentissage Mobile</h3>
                <p>Accédez à nos cours depuis n'importe quel appareil, à tout moment et où que vous soyez.</p>
            </div>
            
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3>Carrière</h3>
                <p>Bénéficiez de notre réseau d'entreprises partenaires pour trouver des opportunités professionnelles.</p>
            </div>
        </div>
    </section>

    <section class="section testimonials" id="testimonials">
        <div class="section-title">
            <h2>Témoignages</h2>
        </div>
        
        <div class="testimonial-slider">
            <div class="testimonial active">
                <div class="testimonial-content">
                    Grâce à EduDark, j'ai pu acquérir les compétences nécessaires pour décrocher mon premier emploi en tant que développeur web. Les cours sont bien structurés et les projets pratiques m'ont vraiment aidé à comprendre les concepts.
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Marie Dupont" class="author-avatar">
                    <div class="author-info">
                        <h4>Marie Dupont</h4>
                        <p>Développeuse Frontend</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="testimonial-content">
                    En tant que professionnel en reconversion, j'ai apprécié la flexibilité des cours et la qualité des ressources. Les mentors sont toujours disponibles pour répondre aux questions et fournir des retours constructifs.
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Jean Martin" class="author-avatar">
                    <div class="author-info">
                        <h4>Jean Martin</h4>
                        <p>Data Scientist</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="testimonial-content">
                    La plateforme offre une excellente variété de cours avec des défis stimulants. J'ai particulièrement aimé les projets en groupe qui m'ont permis de collaborer avec d'autres apprenants du monde entier.
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Sophie Leroy" class="author-avatar">
                    <div class="author-info">
                        <h4>Sophie Leroy</h4>
                        <p>Marketing Digital</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-nav">
                <button class="active" data-index="0"></button>
                <button data-index="1"></button>
                <button data-index="2"></button>
            </div>
        </div>
    </section>

    <footer id="contact">
        <div class="footer-content">
            <div class="footer-column">
                <h3>EduDark</h3>
                <p>La plateforme d'e-learning moderne pour acquérir des compétences professionnelles et transformer votre carrière.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#courses">Cours</a></li>
                    <li><a href="#features">Fonctionnalités</a></li>
                    <li><a href="#testimonials">Témoignages</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Catégories</h3>
                <ul>
                    <li><a href="#">Développement Web</a></li>
                    <li><a href="#">Science des Données</a></li>
                    <li><a href="#">Marketing Digital</a></li>
                    <li><a href="#">Design UX/UI</a></li>
                    <li><a href="#">Business Intelligence</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Contact</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Rue de l'Éducation, Paris</li>
                    <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
                    <li><i class="fas fa-envelope"></i> contact@edudark.com</li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2023 EduDark. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;
        
        // Check for saved user preference or use system preference
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        const currentTheme = localStorage.getItem('theme');
        
        if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
            body.classList.add('dark-mode');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
        
        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('theme', 'dark');
            } else {
                darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('theme', 'light');
            }
        });

        // Image Slider
        const slider = document.getElementById('slider');
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.getElementById('prevSlide');
        const nextBtn = document.getElementById('nextSlide');
        const dotsContainer = document.getElementById('sliderDots');
        
        let currentSlide = 0;
        const slideCount = slides.length;
        
        // Create dots
        slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });
        
        const dots = document.querySelectorAll('.slider-dots button');
        dots[0].classList.add('active');
        
        function updateSlider() {
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }
        
        function goToSlide(slideIndex) {
            currentSlide = (slideIndex + slideCount) % slideCount;
            updateSlider();
        }
        
        function nextSlide() {
            goToSlide(currentSlide + 1);
        }
        
        function prevSlide() {
            goToSlide(currentSlide - 1);
        }
        
        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);
        
        // Auto slide
        let slideInterval = setInterval(nextSlide, 5000);
        
        // Pause on hover
        slider.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });
        
        slider.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 5000);
        });

        // Testimonial Slider
        const testimonials = document.querySelectorAll('.testimonial');
        const testimonialDots = document.querySelectorAll('.testimonial-nav button');
        let currentTestimonial = 0;
        
        function showTestimonial(index) {
            testimonials.forEach(testimonial => testimonial.classList.remove('active'));
            testimonialDots.forEach(dot => dot.classList.remove('active'));
            
            testimonials[index].classList.add('active');
            testimonialDots[index].classList.add('active');
            currentTestimonial = index;
        }
        
        testimonialDots.forEach((dot, index) => {
            dot.addEventListener('click', () => showTestimonial(index));
        });
        
        // Auto rotate testimonials
        setInterval(() => {
            showTestimonial((currentTestimonial + 1) % testimonials.length);
        }, 7000);

        // Animate on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (elementPosition < screenPosition) {
                    element.classList.add('animated');
                }
            });
        }
        
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Run once on load

        // Counter animation
        function animateCounter(element, target, duration = 2000) {
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    clearInterval(timer);
                    current = target;
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 16);
        }
        
        // Start counters when stats section is visible
        const statsSection = document.querySelector('.stats');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(document.getElementById('studentsCount'), 12500);
                    animateCounter(document.getElementById('coursesCount'), 320);
                    animateCounter(document.getElementById('instructorsCount'), 150);
                    animateCounter(document.getElementById('countriesCount'), 85);
                    observer.unobserve(entry.target);
                }
            });