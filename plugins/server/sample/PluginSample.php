<?php

require_once 'modules/admin/models/ServerPlugin.php';

class PluginSample extends ServerPlugin
{
    public $features = [
        'packageName' => false,
        'testConnection' => true,
        'showNameservers' => false,
        'directlink' => false,
        'upgrades' => true,
        'publicPanels' => [
            // issue: it just redirect to product view instead of this custom page. no errors logged.
            'advanced' => 'Advanced'
        ]
    ];

    public function getVariables()
    {
        $variables = [
            'Name' => [
                'type' => 'hidden',
                'description' => 'Used by CE to show plugin',
                'value' => 'Sample'
            ],
            'Description' => [
                'type' => 'hidden',
                'description' => 'Description viewable by admin in server settings',
                'value' => 'Sample Server Plugin'
            ],
            'Website Name Custom Field' => [
                'type' => 'text',
                'description' => 'Enter Website Name',
                'value' => '',
            ],
            'Website URL Custom Field' => [
                'type' => 'text',
                'description' => 'Enter Website URL',
                'value' => '',
            ],
            'package_addons' => [
                'type' => 'hidden',
                'description' => 'Supported signup addons variables',
                'value' => ['DISKSPACE']
            ],
            'Actions' => [
                'type' => 'hidden',
                'description' => 'Current actions that are active for this plugin per server',
                'value' => 'Create,Delete,Suspend,UnSuspend'
            ],
            'package_vars_values' => [
                'type'  => 'hidden',
                'description' => lang('Package Settings'),
                'value' => [
                    'Disk' => [
                        'type' => 'text',
                        'label' => 'Disk Limit',
                        'description' => 'Enter disk limit for this package in MB',
                        'value' => '1024',
                    ],
                ]
            ]
        ];

        return $variables;
    }

    public function validateCredentials($args)
    {
        // issue: wasn't called when an order is created/activated and when a custom field is updated
        CE_Lib::log(4, 'called validateCredentials');
        CE_Lib::log(4, json_encode(['args' => $args]));
    }

    public function doDelete($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $args = $this->buildParams($userPackage);
        $this->delete($args);
        return 'Package has been deleted.';
    }

    public function doCreate($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $args = $this->buildParams($userPackage);
        $this->create($args);
        return 'Package has been created.';
    }

    public function doUpdate($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $args = $this->buildParams($userPackage);
        $this->update($args);
        return 'Package has been updated.';
    }

    public function doSuspend($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $args = $this->buildParams($userPackage);
        $this->suspend($args);
        return 'Package has been suspended.';
    }

    public function doUnSuspend($args)
    {
        $userPackage = new UserPackage($args['userPackageId']);
        $args = $this->buildParams($userPackage);
        $this->unsuspend($args);
        return 'Package has been unsuspended.';
    }

    public function unsuspend($args)
    {
        // Call Unsuspend at the server
    }

    public function suspend($args)
    {
        // Call suspend at the server
    }

    public function delete($args)
    {
        // Call delete at the server
    }

    public function update($args)
    {
        // issue: args['changes'] is always empty
        CE_Lib::log(4, 'called update');
        CE_Lib::log(4, json_encode(['args' => $args]));
    }

    public function getAvailableActions($userPackage)
    {
        $args = $this->buildParams($userPackage);

        $actions = [ 'Create', 'Delete', 'Suspend', 'UnSuspend' ];

        return $actions;
    }

    public function create($args)
    {
        $userPackage = new UserPackage($args['package']['id']);

        // if getCustomField is empty, then get value from args['package']
        
        $websiteName = $userPackage->getCustomField(
            $args['server']['variables']['plugin_dummy_Website Name_Custom_Field'],
            CUSTOM_FIELDS_FOR_PACKAGE
        ) ?? $args['package']['customfields']['Website Name']['value'];
        CE_Lib::log(4, 'Website Name: '.$websiteName);
        
        $websiteUrl = $userPackage->getCustomField(
            $args['server']['variables']['plugin_dummy_Website URL_Custom_Field'],
            CUSTOM_FIELDS_FOR_PACKAGE
        ) ?? $args['package']['customfields']['Website URL']['value'];
        CE_Lib::log(4, 'Website URL: '.$websiteUrl);

        $packageDisk = (int) ($args['package']['variables']['Disk'] ?? 0);
        CE_Lib::log(4, 'Package Disk: '.$packageDisk);
        $addonDisk = (int) ($args['package']['addons']['DISKSPACE'] ?? 0);
        CE_Lib::log(4, 'Addon Disk: '.$addonDisk);

        $totalDisk = $packageDisk + $addonDisk;
        CE_Lib::log(4, 'Total Disk: '.$totalDisk);

        // call create at the server
        // If we need to store custom data for later
        // $userPackage->setCustomField('Server Acct Properties', $externalServerId);
    }

    public function testConnection($args)
    {
        CE_Lib::log(4, 'Testing connection to server');

        // if failed
        //throw new CE_Exception('Connection to server failed.'');
    }

    public function advanced()
    {
        $view->addScriptPath(APPLICATION_PATH . '/../plugins/server/sample/');
        return $view->render('advanced.phtml');
    }
}
