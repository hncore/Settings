<?php

namespace Backpack\Settings\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class SettingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

    public function setup()
    {
        CRUD::setModel(config('hncore.settings.model', \Backpack\Settings\app\Models\Setting::class));
        CRUD::setEntityNameStrings(trans('hncore::settings.setting_singular'), trans('hncore::settings.setting_plural'));
        CRUD::setRoute(hncore_url(config('hncore.settings.route')));
    }

    public function setupListOperation()
    {
        // only show settings which are marked as active
        CRUD::addClause('where', 'active', 1);

        // columns to show in the table view
        CRUD::setColumns([
            [
                'name'  => 'name',
                'label' => trans('hncore::settings.name'),
            ],
            [
                'name'  => 'value',
                'label' => trans('hncore::settings.value'),
            ],
            [
                'name'  => 'description',
                'label' => trans('hncore::settings.description'),
            ],
        ]);
    }

    public function setupUpdateOperation()
    {
        CRUD::addField([
            'name'       => 'name',
            'label'      => trans('hncore::settings.name'),
            'type'       => 'text',
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        CRUD::addField(json_decode(CRUD::getCurrentEntry()->field, true));
    }
}
