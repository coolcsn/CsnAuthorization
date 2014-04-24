--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `resource_id`, `role_id`, `name`, `permission_allow`) VALUES
(1, 1, 1, 'view', 1),
(2, 2, 1, 'view', 1),
(3, 3, 2, 'view', 1),
(4, 4, 3, 'view', 1),
(5, 5, 1, 'index', 1),
(6, 6, 1, 'index', 1),
(7, 6, 1, 'login', 1),
(8, 6, 2, 'logout', 1),
(9, 6, 2, 'login', 0),
(10, 7, 1, 'index', 1),
(11, 7, 2, 'index', 0),
(12, 7, 2, 'editProfile', 1),
(13, 7, 2, 'changePassword', 1),
(14, 7, 1, 'resetPassword', 1),
(15, 7, 2, 'changeEmail', 1),
(16, 7, 2, 'changeSecurityQuestion', 1),
(17, 7, 1, 'confirmEmail', 1),
(18, 8, 3, 'index', 1),
(19, 8, 3, 'createUser', 1),
(20, 8, 3, 'editUser', 1),
(21, 8, 3, 'deleteUser', 1),
(22, 8, 3, 'setUserState', 1),
(23, 9, 1, 'view', 1),
(24, 10, 1, 'view', 1),
(25, 10, 2, 'vote', 1),
(26, 10, 3, 'index', 1),
(27, 10, 3, 'add', 1),
(28, 10, 3, 'edit', 1),
(29, 10, 3, 'delete', 1),
(30, 11, 3, 'view', 1),
(31, 12, 2, 'view', 1),
(32, 13, 3, 'view', 1),
(33, 14, 2, 'view', 1),
(34, 15, 2, 'uri', 1);

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
(8, 'CsnUser\\Controller\\Admin'),
(9, 'CsnCms\\Controller\\Index'),
(10, 'CsnCms\\Controller\\Article'),
(11, 'CsnCms\\Controller\\Translation'),
(12, 'CsnCms\\Controller\\Comment'),
(13, 'CsnCms\\Controller\\Category'),
(14, 'CsnFileManager\\Controller\\Index'),
(15, 'Zend');
