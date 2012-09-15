--
--  Copyright (C) 2012 sateffen
--  https://github.com/sateffen/ShowNewMessagesInMenu-for-Bengine
--
--  This program is free software: you can redistribute it and/or modify
--  it under the terms of the GNU General Public License as published by
--  the Free Software Foundation, either version 3 of the License, or
--  (at your option) any later version.
--
--  This program is distributed in the hope that it will be useful,
--  but WITHOUT ANY WARRANTY; without even the implied warranty of
--  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
--  GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.
--

--
-- Tabellenstruktur für Tabelle `bengine_ProxyUserLog`
--

CREATE TABLE IF NOT EXISTS `bengine_ProxyUserLog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ProxyIP` varchar(15) CHARACTER SET utf8 NOT NULL,
  `RealIP` varchar(15) CHARACTER SET utf8 NOT NULL,
  `Timestamp` bigint(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
