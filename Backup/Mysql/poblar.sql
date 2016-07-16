INSERT INTO `headquarters` VALUES (1,'Rodrigo Facio','facio_1467607692.jpg'),(2,'Sede del atlántico','atlantico_1467607764.jpg'),(4,'Recinto de Golfito','recinto_golfito_1467609386.jpg'),(5,'Sede de Occidente','sede_occidente_1467609473.png'),(6,'Sede de Guanacaste','sede_guanacaste_1467609497.jpg'),(7,'Sede del pacífico','sede_pacífico_1467609532.jpg'),(8,'Sede Interuniversitaria de Alajuela','sede_interuniversitaria_1467609566.jpg');

INSERT INTO `associations` (`id`, `acronym`, `name`, `location`, `schedule`, `authorized_card`, `enable`, `headquarter_id`) VALUES
(1, 'AECCI', 'Asociación de Estudiantes de Ciencias de la Computación', 'San Pedro', '8-10 pm', 0, 1, 1),
(2, 'AEG', 'Asociacion de estudiantes de generales', NULL, '10 am-8 pm', 0, 1, 1),
(3, 'aasas', 'asadsd', 'asasda', 'asdas', 1, 1, 2);

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `last_name_1`, `last_name_2`, `association_id`, `state`) VALUES
(66, 'representante@ucr.ac.cr', '$2y$10$TY39JobDKft00fDMOEqVpuY4.U0UehnxI692S5FofAp8bzz5m2/dG', 'rep', 'Ricardo', 'Vargas', 'Aguilar', 1, 0),
(67, 'administrador@ucr.ac.cr', '$2y$10$G0228sStqUKRzq8/YXMJyuQUMfzifEveBbCG7BZw1FcHAidNWXrSa', 'admin', 'Andrey', 'Pérez', 'Prueba', 1, 0);
