<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/info-page.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <nav>
            <a href="home.php" class="logo"><img src="images/logo.png"></a>
            <input type="text" class="search-bar" placeholder="Search...">
            <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
            <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
            <a href="login.php" class="login-register-btn">Login/Register</a>
        </nav>
    </header>

    <div class="info-container">
        <h3>Terms of Service & Rules</h3>
        <p>Welcome to our online forum community! By accessing or using our website, you agree to abide by the following
            Terms of Service and Rules:</p>

        <h3>1. User Conduct:</h3>
        <ul>
            <li>Be respectful: Treat fellow users with courtesy and refrain from engaging in personal attacks,
                harassment, hate speech, or any form of discrimination.</li>
            <li>No spamming: Do not post repetitive, irrelevant, or promotional content.</li>
            <li>Stay on topic: Keep discussions relevant to the forum's purpose and respective topics.</li>
            <li>Respect privacy: Do not share personal information about yourself or others without consent.</li>
        </ul>

        <h3>2. Content Guidelines:</h3>
        <ul>
            <li>Original content: Ensure that you have the right to share any content you post and avoid copyright
                infringement.</li>
            <li>No illegal content: Do not post or solicit any illegal activities or content that violates applicable
                laws.</li>
            <li>No NSFW content: Do not post any content that can be classified as "Not Safe For Work". This includes
                explicit
                images, videos, text, or any other material that is inappropriate in a professional or public setting.
            </li>
        </ul>

        <h3>3. Moderation:</h3>
        <ul>
            <li>Enforcement: Our moderators have the right to enforce these rules and may take appropriate action,
                including removing content, suspending or banning users, and altering or deleting accounts.</li>
            <li>Appeals: Users may appeal moderation decisions by contacting the moderation team through the appropriate
                channels.</li>
        </ul>

        <h3>4. Liability and Disclaimer:</h3>
        <ul>
            <li>We are not responsible for user-generated content and do not endorse any opinions expressed by users.
            </li>
            <li>We strive to provide a safe and secure platform but cannot guarantee the accuracy, reliability, or
                safety of content posted by users.</li>
        </ul>

        <h3>5. Termination of Service:</h3>
        <ul>
            <li>We reserve the right to terminate or suspend your access to our platform at any time, with or without
                cause and without prior notice.</li>
        </ul>

        <h3>6. Updates to the TOS:</h3>
        <ul>
            <li>We may update or modify these Terms of Service and Rules at any time. It is your responsibility to
                review them periodically for changes.</li>
        </ul>

        <p>By accessing or using our website, you acknowledge that you have read, understood, and agree to abide by
            these Terms of Service and Rules. Failure to comply may result in account suspension or termination. If you
            have any questions or concerns, please contact our moderation team.</p>
    </div>
</body>

</html>