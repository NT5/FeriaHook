INSERT INTO User_Data (User_Type, User_FullName, User_Phone) VALUES
(3, 'Ing. Hendell Jonathan Porras Perez', '+505 88272855'),
(3, 'Ing. Mario Zapata', '+505 84254294'),
(2, 'Ing. Edgardo Cruz', '+505 86955758'),
(2, 'Lic. Elizabeth Cordonero', '+505 86317470'),
(2, 'Lic. María José López', '+505 83656255'),
(2, 'Lic. Esnayda Polanco', '+505 86695234'),
(2, 'Lic. Mario Barberena', '+505 88544095');

INSERT INTO User_Token (User_Id, User_Token) VALUES
((SELECT User_Id FROM User_Data WHERE User_Phone = '+505 88272855'), 'Lm1j'),
((SELECT User_Id FROM User_Data WHERE User_Phone = '+505 84254294'), 'hY90'),
((SELECT User_Id FROM User_Data WHERE User_Phone = '+505 86955758'), 'zUpa'),
((SELECT User_Id FROM User_Data WHERE User_Phone = '+505 86317470'), 'j4US'),
((SELECT User_Id FROM User_Data WHERE User_Phone = '+505 83656255'), 'dxKz'),
((SELECT User_Id FROM User_Data WHERE User_Phone = '+505 86695234'), 'mC79'),
((SELECT User_Id FROM User_Data WHERE User_Phone = '+505 88544095'), 'HJ2l');