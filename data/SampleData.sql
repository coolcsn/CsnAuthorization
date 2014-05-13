
--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `role_id`, `resource`, `privilege`, `is_allowed`) VALUES
(1, 1, 'CsnUser\\Controller\\Index', 'index', 1),
(2, 1, 'CsnUser\\Controller\\Index', 'login', 1),
(3, 1, 'CsnUser\\Controller\\Index', 'logout', 0),
(4, 1, 'CsnUser\\Controller\\Registration', 'index', 1),
(5, 1, 'CsnUser\\Controller\\Registration', 'edit-profile', 0),
(6, 1, 'CsnUser\\Controller\\Registration', 'change-password', 0),
(7, 1, 'CsnUser\\Controller\\Registration', 'reset-password', 1),
(8, 1, 'CsnUser\\Controller\\Registration', 'change-email', 0),
(9, 1, 'CsnUser\\Controller\\Registration', 'change-security-question', 0),
(10, 1, 'CsnUser\\Controller\\Registration', 'confirm-email', 1),
(11, 1, 'CsnUser\\Controller\\Registration', 'confirm-email-change-password', 1),
(12, 1, 'CsnUser\\Controller\\Admin', 'index', 0),
(13, 1, 'CsnUser\\Controller\\Admin', 'create-user', 0),
(14, 1, 'CsnUser\\Controller\\Admin', 'edit-user', 0),
(15, 1, 'CsnUser\\Controller\\Admin', 'set-user-state', 0),
(16, 1, 'CsnUser\\Controller\\Admin', 'delete-user', 0),
(17, 1, 'CsnAuthorization\\Controller\\RoleAdmin', 'index', 0),
(18, 1, 'CsnAuthorization\\Controller\\RoleAdmin', 'create-role', 0),
(19, 1, 'CsnAuthorization\\Controller\\RoleAdmin', 'edit-role', 0),
(20, 1, 'CsnAuthorization\\Controller\\RoleAdmin', 'delete-role', 0),
(21, 2, 'CsnUser\\Controller\\Index', 'index', 1),
(22, 2, 'CsnUser\\Controller\\Index', 'login', 0),
(23, 2, 'CsnUser\\Controller\\Index', 'logout', 1),
(24, 2, 'CsnUser\\Controller\\Registration', 'index', 0),
(25, 2, 'CsnUser\\Controller\\Registration', 'edit-profile', 1),
(26, 2, 'CsnUser\\Controller\\Registration', 'change-password', 1),
(27, 2, 'CsnUser\\Controller\\Registration', 'reset-password', 0),
(28, 2, 'CsnUser\\Controller\\Registration', 'change-email', 1),
(29, 2, 'CsnUser\\Controller\\Registration', 'change-security-question', 1),
(30, 2, 'CsnUser\\Controller\\Registration', 'confirm-email', 1),
(31, 2, 'CsnUser\\Controller\\Registration', 'confirm-email-change-password', 1),
(32, 2, 'CsnUser\\Controller\\Admin', 'index', 0),
(33, 2, 'CsnUser\\Controller\\Admin', 'create-user', 0),
(34, 2, 'CsnUser\\Controller\\Admin', 'edit-user', 0),
(35, 2, 'CsnUser\\Controller\\Admin', 'set-user-state', 0),
(36, 2, 'CsnUser\\Controller\\Admin', 'delete-user', 0),
(37, 2, 'CsnAuthorization\\Controller\\RoleAdmin', 'index', 0),
(38, 2, 'CsnAuthorization\\Controller\\RoleAdmin', 'create-role', 0),
(39, 2, 'CsnAuthorization\\Controller\\RoleAdmin', 'edit-role', 0),
(40, 2, 'CsnAuthorization\\Controller\\RoleAdmin', 'delete-role', 0),
(41, 3, 'CsnUser\\Controller\\Index', 'index', 1),
(42, 3, 'CsnUser\\Controller\\Index', 'login', 0),
(43, 3, 'CsnUser\\Controller\\Index', 'logout', 1),
(44, 3, 'CsnUser\\Controller\\Registration', 'index', 0),
(45, 3, 'CsnUser\\Controller\\Registration', 'edit-profile', 1),
(46, 3, 'CsnUser\\Controller\\Registration', 'change-password', 1),
(47, 3, 'CsnUser\\Controller\\Registration', 'reset-password', 0),
(48, 3, 'CsnUser\\Controller\\Registration', 'change-email', 1),
(49, 3, 'CsnUser\\Controller\\Registration', 'change-security-question', 1),
(50, 3, 'CsnUser\\Controller\\Registration', 'confirm-email', 1),
(51, 3, 'CsnUser\\Controller\\Registration', 'confirm-email-change-password', 1),
(52, 3, 'CsnUser\\Controller\\Admin', 'index', 0),
(53, 3, 'CsnUser\\Controller\\Admin', 'create-user', 0),
(54, 3, 'CsnUser\\Controller\\Admin', 'edit-user', 0),
(55, 3, 'CsnUser\\Controller\\Admin', 'set-user-state', 0),
(56, 3, 'CsnUser\\Controller\\Admin', 'delete-user', 0),
(57, 3, 'CsnAuthorization\\Controller\\RoleAdmin', 'index', 0),
(58, 3, 'CsnAuthorization\\Controller\\RoleAdmin', 'create-role', 0),
(59, 3, 'CsnAuthorization\\Controller\\RoleAdmin', 'edit-role', 0),
(60, 3, 'CsnAuthorization\\Controller\\RoleAdmin', 'delete-role', 0),
(61, 4, 'CsnUser\\Controller\\Index', 'index', 1),
(62, 4, 'CsnUser\\Controller\\Index', 'login', 0),
(63, 4, 'CsnUser\\Controller\\Index', 'logout', 1),
(64, 4, 'CsnUser\\Controller\\Registration', 'index', 0),
(65, 4, 'CsnUser\\Controller\\Registration', 'edit-profile', 1),
(66, 4, 'CsnUser\\Controller\\Registration', 'change-password', 1),
(67, 4, 'CsnUser\\Controller\\Registration', 'reset-password', 0),
(68, 4, 'CsnUser\\Controller\\Registration', 'change-email', 1),
(69, 4, 'CsnUser\\Controller\\Registration', 'change-security-question', 1),
(70, 4, 'CsnUser\\Controller\\Registration', 'confirm-email', 1),
(71, 4, 'CsnUser\\Controller\\Registration', 'confirm-email-change-password', 1),
(72, 4, 'CsnUser\\Controller\\Admin', 'index', 1),
(73, 4, 'CsnUser\\Controller\\Admin', 'create-user', 1),
(74, 4, 'CsnUser\\Controller\\Admin', 'edit-user', 1),
(75, 4, 'CsnUser\\Controller\\Admin', 'set-user-state', 1),
(76, 4, 'CsnUser\\Controller\\Admin', 'delete-user', 1),
(77, 4, 'CsnAuthorization\\Controller\\RoleAdmin', 'index', 1),
(78, 4, 'CsnAuthorization\\Controller\\RoleAdmin', 'create-role', 1),
(79, 4, 'CsnAuthorization\\Controller\\RoleAdmin', 'edit-role', 1),
(80, 4, 'CsnAuthorization\\Controller\\RoleAdmin', 'delete-role', 1);

