INSERT INTO `headquarters` (`id`, `name`, `image_name`) VALUES
(1, 'Rodrigo Facio', 'facio.jpg'),
(2, 'Sede del atlántico', 'atlantico.jpg');

INSERT INTO `associations` (`id`, `acronym`, `name`, `location`, `schedule`, `authorized_card`, `enable`, `headquarter_id`) VALUES
(1, 'AECCI', 'Asociación de Estudiantes de Ciencias de la Computación', 'San Pedro', '8-10 pm', 0, 1, 1),
(2, 'AEG', 'Asociacion de estudiantes de generales', NULL, '10 am-8 pm', 0, 1, 1),
(3, 'aasas', 'asadsd', 'asasda', 'asdas', 1, 1, 2);

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `last_name_1`, `last_name_2`, `association_id`, `state`) VALUES
(1, 'jose', '$2y$10$pN0tmFT2erqmzn8IEdNCEO7VMfNHvQkov/B749P1dM2pYIbz0O8/u', 'admin', 'Jose', 'Slon', 'Baltodano', 1, 0),
(2, 'ricardo', '$2y$10$MQgIEulTS8TQvwwiArI6IeZ6M1nSGiybXu73IMW50r3RvMKlk0Hm2', 'rep', 'Ricardo', 'Aguilar', 'Vargas', 1, 0),
(5, 'andrey', '$2y$10$vr9iJ56rbwPGHKfL.ZoYueEgq3aGETP0izgQQd49mmPnbgFU5ltm2', 'admin', 'Andrey', 'Perez', 'Perez', 1, 0),
(55, 'gabriel', '$2y$10$4.cENrfd8cHuZyqhOzhYBurAIaaqpUdstrgzMGB3bENGZA6U9uN/q', 'rep', 'Gabriel', 'Quesada', 'Monge', 1, 0),
(57, 'testUser', '$2y$10$JcdjrI254cdjnKXl3aTbZ.ADRxC2I6yohYyo.xm/YC3CG5ndd.RVu', 'admin', 'prueba', 'prueba', 'prueba', 1, 0);