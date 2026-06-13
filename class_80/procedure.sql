
delimiter //
CREATE procedure if not exists show_products()
begin
select * from vw_active_products;
select * from products;
end //
delimiter ;

call show_products();

show procedure status where db="Home_task";
drop procedure show_products;



delimiter //
drop procedure if exists create_product;
create procedure create_product(p_name varchar(100), p_brand_id int, p_category_id int, p_price float, p_is_active tinyint)
begin
insert into products(name, brand_id, category_id, price, is_active)
values(p_name, p_brand_id, p_category_id, p_price, p_is_active);
end //
delimiter ;

call create_product("ipad", 1, 3, 1200, 0);