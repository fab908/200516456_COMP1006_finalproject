CREATE DATABASE finalproject;
USE finalproject;
CREATE TABLE accounts(
                         id int(11) NOT NULL AUTO_INCREMENT,
                         fname varchar(255) NOT NULL,
                         lname varchar(255) NOT NULL,
                         email varchar(255) NOT NULL,
                         password varchar(255) NOT NULL,
                         image VARCHAR(255),
                         PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO accounts (fname, lname, email, password, image)
VALUES
    ('Ricky', 'Lafleaur', 'RickyLafleaur@gmail.com', 'cfca4f3b1a0110da0be45e3f7c45838fe5b4a6603d51b1def8625d80c597ec641831ad219c120e97bc4cc8eea1b9828691f99e754b12fd7ace5991b725233264', './img/uploads/ricky.jpg'),
    ('Julian', 'Jules', 'JulianJules@gmail.com', 'e839d17f865f0af341296c6d91a69b0b67d24ba387688bed9827dc7d2efc4ecc810f2e780419bf3275b4c08f657601b2323d079d3fd3dab328b276852299e370', './img/uploads/julian.jpg'),
    ('Bubbles', 'Bubs', 'CartRepairs@gmail.com', 'fadab56021661bb72f36bf57553423a59a482dc8647ab0fbf7fe608c9dc689e2373f1ae3bae426e7751cc0d7034727a578e2a4b090261bf9a4f24aad9d5216e0', './img/uploads/bubbles.jpg'),
    ('Conky', 'Bubs', 'ConkyBubs@gmail.com', 'db32ca95d98a7fbb9c5f24210548d156f4224cb1ce150f0ef7e0d1a48091b3e71899ff0d814318913c186320a8cb942a029efe1d8f6b0cba1219ef6b62d47062', './img/uploads/conky.jpg'),
    ('Jamie', 'Roc', 'JRoc@gmail.com', 'c2d8eb7973598d030b658224edbe0931429d69f65690609a344b7300db1a80be8b775629a011039e3a74239dc3d679a7b0a37313952a82aeb80f9de219860ce4', './img/uploads/jroc.jpg'),
    ('Jared', 'Bently', 'JaredBently@gmail.com', 'f4bd2a42f14d05c69e4e0ad341335a472154b0aa771e18d88e13b84e405f4a46c4ef84d63877c2bb950e1ae8dfacd31a2719d13793f99765c16382ec68e567ca', './img/uploads/jared.jpg');
CREATE TABLE posts(
                      post_id int(11) NOT NULL AUTO_INCREMENT,
                      account_id int(11) NOT NULL,
                      image varchar(255) NOT NULL,
                      description varchar(255),
                      comment1 varchar(255),
                      comment2 varchar(255),
                      comment3 varchar(255),
                      comment4 varchar(255),
                      visible BOOLEAN DEFAULT TRUE,
                      PRIMARY KEY (post_id),
                      FOREIGN KEY (account_id) REFERENCES accounts(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO posts (account_id, image, description, comment1, comment2)
VALUES
    ('1', './img/uploads/print1.jpg', 'Just started printing this and hopefully it will come out nice! will keep you updated', 'VERY COOL', 'cant wait to see it done!'),
    ('2', './img/uploads/print2.jpg', 'Learned how to get super smooth prints check this one out', 'WOW please teach me!!', ''),
    ('3', './img/uploads/print4.jpg', 'Trying to print all three at the same time wish me luck', 'Good Luck!', 'Hopefully it goes well'),
    ('4', './img/uploads/print5.jpg', 'Another Print', 'wow so smooth', ''),
    ('5', './img/uploads/jared.jpg', 'new to this website heres one of my prints!', 'Welcome to this website!', '');