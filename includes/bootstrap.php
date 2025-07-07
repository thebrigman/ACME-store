<?php
function ensureSchema(mysqli $conn): void
{
    // Check if the 'user' table already exists
    $check = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
    if (mysqli_num_rows($check) > 0) {
        return; // Already installed, nothing to do
    }

    // If it doesn't exist, create everything
    $sql = <<<'SQL'
    -- CREATE DATABASE IF NOT EXISTS 'final'
    --   DEFAULT CHARSET = utf8mb4
    --   COLLATE       = utf8mb4_unicode_ci;

    -- USE 'final';

    CREATE TABLE IF NOT EXISTS `users` (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50)  NOT NULL UNIQUE,
        password VARCHAR(512) NOT NULL
    ) ENGINE = InnoDB;

    INSERT INTO `users` (username, password)
    VALUES ('admin', 'password')
    ON DUPLICATE KEY UPDATE password = VALUES(password);

    CREATE TABLE IF NOT EXISTS `PRODUCT` (
        ID          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        NAME        VARCHAR(50)  NOT NULL,
        DESCRIPTION VARCHAR(500) NOT NULL,
        IMAGE       VARCHAR(100) NOT NULL,
        PRICE       FLOAT        NOT NULL
    ) ENGINE = InnoDB;

    INSERT INTO `PRODUCT` (NAME, DESCRIPTION, IMAGE, PRICE) VALUES
      ('Anvil', 'Steel anvil', 'img/1.jpeg', 79.99),
      ('Axle Grease', 'Keeps wheels turning', 'img/2.jpeg', 6.49),
      ('Atom Re-Arranger', 'Portable transmutation device (results may vary).', 'img/3.jpeg', 1399.95),
      ('Bed Springs', 'Extra-bouncy springs for high-altitude pounces.', 'img/4.jpeg', 12.50),
      ('Bird Seed', 'Premium gourmet mix guaranteed to attract roadrunners.', 'img/5.jpeg', 4.25),
      ('Blasting Powder', 'Multi-purpose ACME-brand black powder, fuse sold separately.', 'img/6.jpeg', 18.00),
      ('Cork', 'Oversized cork perfectly fits most cartoon cannons.', 'img/7.jpeg', 1.15),
      ('Disintegration Pistol', 'Point-and-zap disassembly of inconvenient obstacles.', 'img/8.jpeg', 249.00),
      ('Earthquake Pills', 'Just one pill produces seismic surprises for your target.', 'img/9.jpeg', 34.95),

    ('Female Roadrunner Costume',
     'Ultra-realistic disguise with tail feathers and beep-beep module.',
     'img/10.jpeg', 129.99),

    ('Giant Rubber Band',
     'Industrial-strength slingshot component for long-range launches.',
     'img/11.jpeg', 22.75),

    ('Instant Girl',
     'Inflatable distraction device (assembly in 3 seconds).',
     'img/12.jpeg', 9.95),

    ('Iron Carrot',
     'Heavy decoy carrot—hard to bite, impossible to resist.',
     'img/13.jpeg', 7.25),

    ('Jet Propelled Unicycle',
     'Unicycle plus rocket equals ridiculous velocity.',
     'img/14.jpeg', 499.00),

    ('Out-Board Motor',
     'Attach to anything for spontaneous aquatic escapades.',
     'img/15.jpeg', 199.99),

    ('Railroad Track',
     'Ten meters of portable rail for trap-laying on the go.',
     'img/16.jpeg', 42.00),

    ('Rocket Sled',
     'Classic ACME surface-to-anvil delivery platform.',
     'img/17.jpeg', 649.00),

    ('Super Outfit',
     'Tight suit, flowing cape—flight not guaranteed.',
     'img/18.jpeg', 59.95),

    ('Time Space Gun',
     'Bend reality! (Warranty void if timeline destroyed.)',
     'img/19.jpeg', 1499.00),

    ('X-Ray',
     'Handheld x-ray camera for sight-unseen scheming.',
     'img/20.jpeg', 349.50);

    SQL;

    // Run the multi-statement SQL
    if (!mysqli_multi_query($conn, $sql)) {
        die("Database setup failed: " . mysqli_error($conn));
    }

    // Flush results (needed after mysqli_multi_query)
    while (mysqli_more_results($conn)) {
        mysqli_next_result($conn);
    }

    echo "<p>✅ Database was created automatically.</p>";
}
