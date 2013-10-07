--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `name`) VALUES
(1, 'all'),
(2, 'Public Resource'),
(3, 'Private Resource'),
(4, 'Admin Resource'),
(5, 'Application\\Controller\\Index'),
(6, 'CsnUser\\Controller\\Index'),
(7, 'CsnUser\\Controller\\Registration'),
(8, 'CsnCms\\Controller\\Index'),
(9, 'CsnCms\\Controller\\Article'),
(10, 'CsnCms\\Controller\\Translation'),
(11, 'CsnCms\\Controller\\Comment'),
(12, 'CsnCms\\Controller\\Category'),
(13, 'CsnFileManager\\Controller\\Index'),
(14, 'Zend'),
(15, 'Application\\Controller\\Index');

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `resource_id`, `role_id`, `name`, `permission_allow`) VALUES
(1, 5, 1, 'index', 1),
(2, 7, 1, 'index', 1),
(3, 7, 2, 'changePassword', 1),
(4, 7, 2, 'editProfile', 1),
(5, 7, 2, 'changeEmail', 1),
(6, 7, 1, 'forgottenPassword', 1),
(7, 7, 1, 'confirmEmail', 1),
(8, 7, 1, 'registrationSuccess', 1),
(9, 6, 1, 'login', 1),
(10, 6, 2, 'logout', 1),
(11, 6, 1, 'index', 1),
(12, 8, 1, NULL, 1),
(13, 9, 1, 'view', 1),
(14, 9, 2, 'vote', 1),
(15, 9, 3, 'index', 1),
(16, 9, 3, 'add', 1),
(17, 9, 3, 'edit', 1),
(18, 9, 3, 'delete', 1),
(19, 10, 3, NULL, 1),
(20, 11, 2, NULL, 1),
(21, 12, 3, NULL, 1),
(22, 13, 2, NULL, 1),
(23, 14, 2, 'uri', 1),
(24, 15, 1, 'index', 1),
(25, 1, 1, 'view', 1),
(26, 2, 1, 'view', 1),
(27, 3, 2, 'view', 1),
(28, 4, 3, 'view', 1),
(29, 6, 2, 'login', 0),
(30, 7, 2, 'index', 0);