select email from users group by email having count(email) > 1;
select u.login from users u left join orders o on u.id = o.user_id where o.id is null;
select u.login from users u left join orders o on u.id = o.user_id where o.id is not null group by o.user_id having COUNT(o.user_id) > 2;
