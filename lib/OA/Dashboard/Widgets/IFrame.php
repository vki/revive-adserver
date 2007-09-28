<?php

/*
+---------------------------------------------------------------------------+
| Openads v${RELEASE_MAJOR_MINOR}                                                              |
| ============                                                              |
|                                                                           |
| Copyright (c) 2003-2007 Openads Limited                                   |
| For contact details, see: http://www.openads.org/                         |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id$
*/

require_once MAX_PATH . '/lib/OA/Dashboard/Widget.php';

/**
 * A class to display the dashboard iframe content
 *
 */
class OA_Dashboard_Widget_Iframe extends OA_Dashboard_Widget
{
    var $serviceURL;

    /**
     * The class constructor
     *
     * @param array $aParams The parameters array, usually $_REQUEST
     * @return OA_Dashboard_Widget
     */
    function OA_Dashboard_Widget_Iframe($aParams)
    {
        parent::OA_Dashboard_Widget($aParams);

        if (isset($aParams['url'])) {
            $url = $aParams['url'];
        } else {
            $url = $this->buildUrl($GLOBALS['_MAX']['CONF']['oacDashboard']);
        }

        $this->setServiceUrl($aParams['url']);
    }

    function setServiceUrl($serviceURL) {
        $this->serviceUrl = $serviceURL;
    }

    /**
     * A method to launch and display the widget
     *
     */
    function display()
    {
        $aConf = $GLOBALS['_MAX']['CONF'];

        $oTpl = new OA_Admin_Template('dashboard/iframe.html');

        $this->getCredentials();

        $oTpl->assign('dashboardURL', MAX::constructURL(MAX_URL_ADMIN, 'dashboard.php?widget=IFrame'));
        $oTpl->assign('errorURL',     MAX::constructURL(MAX_URL_ADMIN, 'dashboard.php?widget=Login&error='));
        $oTpl->assign('ssoAdmin',     $this->ssoAdmin);
        $oTpl->assign('ssoPasswd',    $this->ssoPasswd);
        $oTpl->assign('casLoginURL',  $this->buildUrl($aConf['oacSSO']));
        $oTpl->assign('serviceURL',   $this->serviceUrl);

        $oTpl->display();
    }
}

?>