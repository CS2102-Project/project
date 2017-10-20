--For markets display, select posts that don't belong to the current user
SELECT * from posts p where p.item not in (
  SELECT i.itemid from items i where i.owner = user_email
);

--Insert new entries into bids table
INSERT INTO bids (bidder, post, points) VALUES (email, postid, points);

