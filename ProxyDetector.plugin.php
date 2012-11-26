<?php
/*
 *  Copyright (C) 2012 sateffen
 *  https://github.com/sateffen/ProxyDetector-for-Bengine
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class Plugin_ProxyDetector extends Recipe_PluginAbstract
{

	/**
	 * Defines basic plug in information.
	 *
	 * @return Plugin_Commercials
	 */
	public function __construct()
	{
		$this->pluginName = 'ProxyDetector';
		$this->pluginVersion = '1.0';
		return $this;
	}

	/**
	 * Checks wheather the user uses a proxy and logs this
	 *
	 * @param Login	    The Login util
	 * @param string    Session URL
	 *
	 * @return Plugin_TORUserDetector
	 */
	public function onStartSession( Login $Login , $sessionURL )
	{
		$possibleProxyHeader = array(
									'HTTP_VIA',
									'HTTP_X_FORWARDED_FOR',
									'HTTP_FORWARDED_FOR',
									'HTTP_X_FORWARDED',
									'HTTP_FORWARDED',
									'HTTP_CLIENT_IP',
									'HTTP_FORWARDED_FOR_IP',
									'VIA',
									'X_FORWARDED_FOR',
									'FORWARDED_FOR',
									'X_FORWARDED',
									'FORWARDED',
									'CLIENT_IP',
									'FORWARDED_FOR_IP',
									'HTTP_PROXY_CONNECTION'
								);
		$ProxyIP = NULL;
		$RealIP = NULL;
		foreach( $possibleProxyHeader as $header ) {
			if ( isset( $_SERVER[ $header ] ) ) {
				$ProxyIP = substr( trim( preg_replace( '/[A-z]/' , '' , $_SERVER[ $header ] ) ) , 0 , 15 );
				$RealIP = substr( trim( preg_replace( '/[A-z]/' , '' , $_SERVER['REMOTE_ADDR'] ) ) , 0 , 15 );
				break;
			}
		}
		if ( !empty( $ProxyIP ) && $ProxyIP !== NULL ) {		
			Core::getQuery()->insertInto( 'ProxyUserLog' , array( 
                                                                    'ID' => '' , 
                                                                    'UserID' => $Login->getUserId() , 
                                                                    'ProxyIP' => $RealIP , 
                                                                    'RealIP' => $ProxyIP ,
                                                                    'Timestamp' => time() 
                                                                ) );
        }
        return $this;
    }
}

Hook::addHook( 'StartSession' , new Plugin_ProxyDetector() );
?>
