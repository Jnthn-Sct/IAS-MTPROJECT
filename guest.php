
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8eed4;
            width: 100vw;
            height: 100vh;
            min-height: 100vh;
            min-width: 100vw;
            display: flex;
        }
        .sidebar {
            width: 240px;
            background: #005524;
            border-right: 1.5px solid #e6e6e6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            height: 100vh;
            justify-content: flex-start;
        }
        .sidebar .logo {
            width: 200px;
            max-width: 90%;
            margin-top: 18px;
            margin-bottom: 0px;
            display: block;
            align-self: center;
        }
        .sidebar .nav {
            width: 100%;
            margin-top: 18px;
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 32px;
            color: #f8eed4;
            font-size: 1.08rem;
            text-decoration: none;
            font-weight: 600;
            border-left: 4px solid transparent;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #f69f00;
            border-left: 4px solid #43cea2;
            color: #0f9b8e;
        }
        .sidebar .nav-link i {
            margin-right: 14px;
            font-size: 1.2em;
        }
        .sidebar .bottom-links {
            margin-top: auto;
            width: 100%;
            margin-bottom: 32px;
        }
        .sidebar .bottom-links .nav-link {
            color: #f8eed4;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }
        .dashboard-header {
            padding: 0 40px 0 40px;
            background: #005524;
            border-bottom: 1.5px solid #e6e6e6;
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .dashboard-header h2 {
            margin: 0 0 6px 0;
            font-size: 2rem;
            font-weight: 700;
            color: #f8eed4;
        }
        .dashboard-header .greeting {
            color: #f69f00;
            font-size: 1.1rem;
        }
        .features-section {
            flex: 1;
            padding: 32px 40px;
            background: #f8eed4;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            height: 100%;
            overflow: hidden;
        }
        .features-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #005524;
            margin-bottom: 18px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 32px;
            width: 100%;
            height: 100%;
            align-items: center;
            justify-items: center;
        }
        .feature-card {
            background: linear-gradient(135deg, #005524 0%, #0f9b8e 100%);
            color: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px 0 rgba(31,38,135,0.07);
            padding: 12px 12px 12px 14px;
            text-align: left;
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
            min-width: 0;
            min-height: 0;
            width: 90%;
            height: 90%;
            max-width: 180px;
            max-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            position: relative;
        }
        .feature-card .feature-icon {
            font-size: 1.3rem;
            margin-bottom: 4px;
        }
        .feature-card .feature-title {
            font-weight: 700;
            font-size: 0.98rem;
            margin-bottom: 1px;
        }
        .feature-card .feature-desc {
            font-size: 0.85rem;
            color: #e6e6e6;
        }
        .feature-card:hover {
            box-shadow: 0 6px 24px 0 rgba(31,38,135,0.13);
            transform: translateY(-4px) scale(1.03);
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.25);
            justify-content: center;
            align-items: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: #fff;
            border-radius: 16px;
            padding: 36px 32px 28px 32px;
            min-width: 320px;
            max-width: 90vw;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            text-align: center;
            position: relative;
        }
        .modal-content h3 {
            margin-top: 0;
            color: #226b3a;
        }
        .modal-close {
            position: absolute;
            top: 16px;
            right: 18px;
            font-size: 1.3rem;
            color: #888;
            background: none;
            border: none;
            cursor: pointer;
        }
        @media (max-width: 1200px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(5, 1fr);
                gap: 18px;
            }
            .feature-card {
                max-width: 95vw;
                max-height: 100px;
                width: 95%;
                height: 90%;
            }
        }
        @media (max-width: 700px) {
            .features-grid {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(10, 1fr);
                gap: 12px;
            }
            .features-section {
                padding: 8px 2vw;
            }
            .feature-card {
                max-width: 98vw;
                max-height: 80px;
                width: 98%;
                height: 90%;
            }
        }
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
            margin-left: 10px;
            vertical-align: middle;
        }
        .toggle-switch input { display: none; }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ccc;
            border-radius: 24px;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #005524;
        }
        input:checked + .slider:before {
            transform: translateX(24px);
        }
        .settings-row {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            justify-content: space-between;
        }
        .settings-row label {
            margin-bottom: 0;
        }
        .profile-content .profile-info {
            margin-bottom: 18px;
            font-size: 1.1rem;
            color: #005524;
        }
        .settings-content, .profile-content {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px 0 rgba(31,38,135,0.07);
            padding: 40px 40px 32px 40px;
            margin: 40px auto;
            max-width: 520px;
            min-width: 260px;
            font-size: 1.18rem;
            line-height: 1.7;
            text-align: left;
        }
        .settings-content h3, .profile-content h3 {
            color: #005524;
            margin-top: 0;
            margin-bottom: 24px;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .settings-row, .profile-info {
            margin-bottom: 28px;
        }
        .settings-content label, .profile-content label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #005524;
            font-size: 1.08rem;
        }
        .settings-content input, .profile-content input, .settings-content select {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1.08rem;
        }
        .settings-content button, .profile-content button {
            background: #005524;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 28px;
            font-size: 1.08rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
        }
        .settings-content button:hover, .profile-content button:hover {
            background: #0f9b8e;
        }
        .profile-content .profile-info {
            font-size: 1.18rem;
            color: #005524;
            margin-bottom: 28px;
            word-break: break-word;
        }
        /* Remove Settings-related CSS */
        .settings-content, .settings-row, #settingsSection, #pushToggle, #darkModeToggle, .toggle-switch, .slider { display: none !important; }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="Calasag-logo.png" alt="Logo" class="logo" />
        <nav class="nav">
            <a href="#" class="nav-link active"><i class="fa fa-home"></i><span>Dashboard</span></a>
        </nav>
        <div class="bottom-links">
            <a href="#" id="logoutBtn" class="nav-link"><i class="fa fa-sign-out-alt"></i><span>Logout</span></a>
        </div>
    </div>
    <div class="main-content">
        <div class="dashboard-header">
            <h2 id="mainTitle">Dashboard</h2>
            <div class="greeting">Welcome, Guest!</div>
        </div>
<div class="features-section content-section active" id="dashboardSection">
            <div class="features-title">Features of CALASAG</div>
            <div class="features-grid">
                <div class="feature-card" data-feature="Safety Tips">
                    <div class="feature-icon">💡</div>
                    <div class="feature-title">Safety Tips & Resources</div>
                    <div class="feature-desc">Guides and resources to keep you safe.</div>
                </div>
                <div class="feature-card" data-feature="Crowdsourced Ratings">
                    <div class="feature-icon">⭐</div>
                    <div class="feature-title">Crowdsourced Ratings</div>
                    <div class="feature-desc">See safety ratings from the community.</div>
                </div>
                <div class="feature-card" data-feature="Emergency Contacts">
                    <div class="feature-icon">⚙️</div>
                    <div class="feature-title">Your Access is Limited.</div>
                    <div class="feature-desc">You are not able to view all of the contents of this website as you are a guest.</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="featureModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModalBtn"><i class="fa fa-times"></i></button>
            <h3 id="modalTitle">Feature Title</h3>
            <div id="modalBody">Feature details will appear here.</div>
        </div>
    </div>
    <!-- Logout Confirmation Modal -->
    <div class="modal" id="logoutModal">
        <div class="modal-content">
            <h3>Confirm Logout</h3>
            <p>Are you sure you want to log out?</p>
            <button id="confirmLogout">Yes, Logout</button>
            <button id="cancelLogout">No</button>
        </div>
    </div>
    <script>
        // Modal functionality
        const featureCards = document.querySelectorAll('.feature-card');
        const modal = document.getElementById('featureModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalTitle = document.getElementById('modalTitle');
        const modalBody = document.getElementById('modalBody');
        featureCards.forEach(card => {
            card.addEventListener('click', () => {
                modalTitle.textContent = card.querySelector('.feature-title').textContent;
                modalBody.textContent = 'More information about ' + card.querySelector('.feature-title').textContent + ' will appear here.';
                modal.classList.add('active');
            });
        });
        closeModalBtn.addEventListener('click', () => {
            modal.classList.remove('active');
        });
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
        // Sidebar navigation logic (Dashboard and My Profile only)
        const dashboardSection = document.getElementById('dashboardSection');
        const profileSection = document.getElementById('profileSection');
        const mainTitle = document.getElementById('mainTitle');
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.textContent.includes('Dashboard')) {
                    dashboardSection.classList.add('active');
                    dashboardSection.style.display = '';
                    profileSection.classList.remove('active');
                    profileSection.style.display = 'none';
                    mainTitle.textContent = 'Dashboard';
                } else if (this.textContent.includes('My Profile')) {
                    dashboardSection.classList.remove('active');
                    dashboardSection.style.display = 'none';
                    profileSection.classList.add('active');
                    profileSection.style.display = '';
                    mainTitle.textContent = 'My Profile';
                } else if (this.textContent.includes('Logout')) {
                    e.preventDefault();
                    document.getElementById('logoutModal').classList.add('active');
                }
                navLinks.forEach(l => l.classList.remove('active'));
                if (!this.textContent.includes('Logout')) this.classList.add('active');
            });
        });
        // Logout confirmation modal logic
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            logoutModal.classList.add('active');
        });
        confirmLogout.addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
        cancelLogout.addEventListener('click', function() {
            logoutModal.classList.remove('active');
        });
    </script>
</body>
</html>