-----Our queries for this application

--Insertions
INSERT INTO bids (bidder, post, points) VALUES (email, postid, points);
INSERT INTO loans (bid, post, status) values($bidId, postid, using_status);
INSERT INTO items (description, available, name, owner, avatar) values (description,
                   available, name, owner, filename);
INSERT INTO posts (item, title, location, description) VALUES (itemId, title, location, description);
INSERT INTO bids (status, bidder, post, points) VALUES ('FAILURE', email, postid, point);


--Other simpler operation's queries
SELECT * FROM bids WHERE bids.bidid = bidid; --for edit bid
SELECT * FROM item i; --for display items
SELECT * FROM posts WHERE posts.postid = postid; --for edit post
SELECT * FROM users WHERE users.id = userid; --for getting the current user's full information
DELETE FROM bids WHERE bids.bidid = bidid; --for bids deletion
DELETE from posts where posts.postid = postid; --for posts deletion
UPDATE bids set bids.points = points_updated where bids.bidid = bidid; --for bidding point update logic
UPDATE bids set bids.status = 'SUCCESS' where bids.bidid = bidid; --for bidding status update logic
UPDATE users set users.points_available = users.points_available + points where users.id = userid; --for bidding points update logic
UPDATE loans l set l.status = 'RETURNED' where l.loanid = loanid;
UPDATE posts set posts.title = title, posts.location = location, posts.description = description where posts.postid = postid;


--For market display without the user's posts
SELECT p.postid, p.title, p.description, p.created_at, i1.avatar 
FROM posts p, items i1 
WHERE p.item NOT IN 
    (SELECT i.itemid FROM items i WHERE i.owner =email)
AND p.item = i1.itemid;

--For selecting the posts that the current user owns, and are currently being bid by other users.
SELECT * FROM posts p, items i 
WHERE p.item=i.itemid AND i.owner = email;



--Transaction history
SELECT u1.username as owner, u2.username as bidder, b.points, b.updated_at as time
FROM users u1, users u2, bids b, items i, posts p
WHERE b.bidder = u2.email AND b.post = p.postid AND p.item = i.itemid AND i.onwer = u1.email
AND (b.bidder = email OR i.owner =email);

--User items average popularity
SELECT AVG(num)
FROM
(SELECT i.itemid, COUNT(b.bidid) as num
FROM posts p, bids b, items i
WHERE b.post = p.postid AND p.item = i.itemid AND i.owner = email
GROUP BY i.itemid) as derived;

--User bidding posts average popularity (error contained)
SELECT AVG(num)
FROM
(SELECT COUNT(b.bidid) as num from
(SELECT p.postid as postid
FROM posts p, bids b
WHERE p.postid = b.post and b.bidder = email) as myposts), bids b
WHERE b.post = myposts.postid) as derived;

--MAX bidding points for a specific post
SELECT MAX(b.points)
FROM bids b, posts p
WHERE b.post = p.postid AND p.postid = postid;

-- This query should be run only once
--DROP VIEW if exists item_popularity
--CREATE VIEW item_popularity AS
--SELECT i.itemid as itemid, i.owner as owner, COUNT(*) AS popularity
--FROM items i, posts p, bids b
--WHERE i.itemid = p.item AND p.postid = b.post
--GROUP BY i.itemid, i.owner;

SELECT u.email, AVERAGE(i.popularity)
FROM users u, item_popularity i
WHERE u.email = i.owner
GROUP BY u.email;

SELECT u.email, AVERAGE(i.popularity)
FROM users u, item_popularity i, posts p, bids b, loans loans
WHERE u.email = b.bidder AND b.bidid = l.bid AND b.post = p.postid AND p.item = i.itemid
GROUP BY u.email;