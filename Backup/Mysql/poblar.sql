insert into boxes(id,little_amount,big_amount,type,association_id,tract_id) values(1,25000,100000,0,1,1);

insert into invoices(id,number,provider,amount,clarifications,image_name,detail,kind,state,date,attendant,association_id,tract_id) values(1,1,'PriceSmart',25000,'Factura de PriceSmart','price_smart_image','Se compró un futbolín',0,1,'2016-10-20','Andrey Pérez',1,1);
insert into invoices(id,number,provider,amount,clarifications,image_name,detail,kind,state,date,attendant,association_id,tract_id) values(2,2,'PriceSmart',25000,'Factura de PriceSmart','price_smart_image','Se compró un futbolín',0,1,'2016-10-20','Andrey Pérez',1,1);

insert into amounts(id,amount,detail,type,association_id,tract_id) values(51,250000,"Ingresos generados",1,1,1);	
insert into amounts(id,amount,detail,type,association_id,tract_id) values(51,250000,"Ingresos generados",1,1,2);
insert into boxes(id,little_amount,big_amount,type,association_id,tract_id) values(1,25000,100000,1,1,1);
insert into boxes(id,little_amount,big_amount,type,association_id,tract_id) values(1,25000,100000,1,1,2);
insert into invoices(id,number,provider,amount,clarifications,image_name,detail,kind,state,date,attendant,association_id,tract_id) values(2,2,'PriceSmart',25000,'Factura de PriceSmart','price_smart_image','Se compró un futbolín',1,1,'2016-10-20','Andrey Pérez',1,1);
insert into invoices(id,number,provider,amount,clarifications,image_name,detail,kind,state,date,attendant,association_id,tract_id) values(2,2,'PriceSmart',25000,'Factura de PriceSmart','price_smart_image','Se compró un futbolín',1,1,'2016-10-20','Andrey Pérez',1,2);