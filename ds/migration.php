<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//CREATE TABLE units (
//id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//name VARCHAR(30) NOT NULL
//);

/*
CREATE TABLE items_list(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
unit_id INT(11) UNSIGNED,
name VARCHAR(30) NOT NULL,
weight VARCHAR(30) NULL,
price DECIMAL(10,2) NULL,
unit_price DECIMAL(10,2) NULL
); 
 


CREATE TABLE prepared_materials(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL
); 
CREATE TABLE prepared_material_items(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
material_id INT(11) UNSIGNED,
item_id INT(11) UNSIGNED,
weight VARCHAR(30) NULL,
FOREIGN KEY (material_id) REFERENCES prepared_materials(id),
FOREIGN KEY (item_id) REFERENCES items_list(id)
); 

*/
