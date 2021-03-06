<?php

namespace App\Admin\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Section;

/**
 * Class Users
 *
 * @property \App\Models\User $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Users extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    const NOT_SPECIFIED = 'Не указано';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fa fa-lightbulb-o');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::image('preview', 'Image'),
            AdminColumn::link('name', 'Name')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('name', 'like', '%'.$search.'%')
                        ->orWhere('created_at', 'like', '%'.$search.'%')
                    ;
                })
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('created_at', $direction);
                })
            ,
            AdminColumn::boolean('name', 'On'),
            AdminColumn::text('created_at', 'Created / updated')
                ->setWidth('160px')
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('updated_at', $direction);
                })
                ->setSearchable(false)
            ,
        ];

        $display = AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;

        $display->setColumnFilters([
            AdminColumnFilter::select()
                ->setModelForOptions(\App\Models\User::class, 'name')
                ->setLoadOptionsQueryPreparer(function($element, $query) {
                    return $query;
                })
                ->setDisplay('name')
                ->setColumnName('name')
                ->setPlaceholder('All names')
            ,
        ]);
        $display->getColumnFilters()->setPlacement('card.heading');

        return $display;
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
    public function onEdit($id = null, $payload = [])
    {
        $isReadOnly = function () {
            if ($this->getCreateUrl() == request()->url()) {
                return false;
            }

            return true;
        };

        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('name', 'Name')
                    ->required()
                ,
                AdminFormElement::datetime('created_at')
                    ->setVisible(true)
                    ->setReadonly(false)
                ,
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-4')->addColumn([
                AdminFormElement::text('id', 'ID')->setReadonly(true),
            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-8'),
            AdminFormElement::columns()->addColumn([
               AdminFormElement::image('image', 'User image'),
            ], 'col-xs-12 col-sm-6 col-md-6 col-lg-2'),
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('info.phone', 'Номер телефона')
                        ->setReadonly($isReadOnly())
                        ->setDefaultValue(static::NOT_SPECIFIED),
                ])->addColumn([
                    AdminFormElement::text('info.telegram', "Телеграм")
                        ->setReadonly($isReadOnly())
                        ->setDefaultValue(static::NOT_SPECIFIED)
                ])->addColumn([
                    AdminFormElement::text('info.facebook', "Facebook")
                        ->setReadonly($isReadOnly())
                        ->setDefaultValue(static::NOT_SPECIFIED)
                ]),
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('info.vk', 'Вконтакте')
                        ->setReadonly($isReadOnly())
                        ->setDefaultValue(static::NOT_SPECIFIED)
                ])->addColumn([
                    AdminFormElement::text('info.skype', 'Skype')
                        ->setReadonly($isReadOnly())
                        ->setDefaultValue(static::NOT_SPECIFIED)
                ])->addColumn([
                    AdminFormElement::text('info.whatsup', 'WhatsUp')
                        ->setReadonly($isReadOnly())
                        ->setDefaultValue(static::NOT_SPECIFIED)
                ])


        ]);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'save_and_create'  => new SaveAndCreate(),
            'cancel'  => (new Cancel()),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        return $this->onEdit(null, $payload);
    }
}
