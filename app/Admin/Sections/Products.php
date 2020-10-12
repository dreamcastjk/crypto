<?php

namespace App\Admin\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Facades\Meta;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Products
 *
 * @property \App\Models\Product $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Products extends Section implements Initializable
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

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->title = 'Продукты';
        $this->icon = 'fa fa-book';
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
            AdminColumn::link('title', 'Title', 'created_at')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('title', 'like', '%'.$search.'%')
                        ->orWhere('created_at', 'like', '%'.$search.'%')
                    ;
                })
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('created_at', $direction);
                })
            ,
            AdminColumn::text('hashrate', 'Hashrate', 'hashrate_unit')
                ->setWidth('100px')
                ->setHtmlAttribute('class', 'text-right')
                ->setSearchCallback(function ($column, $query, $search) {
                    return $query
                        ->orWhere('hashrate', '=', $search)
                        ->orWhere('hashrate_unit', '=', $search);
                }),
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
                ->setModelForOptions(\App\Models\Product::class, 'title')
                ->setLoadOptionsQueryPreparer(function($element, $query) {
                    return $query;
                })
                ->setDisplay('title')
                ->setColumnName('title')
                ->setPlaceholder('Все названия')
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
        Meta::addJs('admin-custom-js-1', asset('admin_resources/js/slug-generate.js'), ['admin-default']);

        $tabs = AdminDisplay::tabbed();
        $tabs->setTabs(function ($id) {
           $tabs = [];
           $tabs[] = AdminDisplay::tab(
               new FormElements([
                   AdminFormElement::columns()
                       ->addColumn([AdminFormElement::text('title', 'Название')->required()])
                       ->addColumn([AdminFormElement::text('slug', 'Slug (для url)')->required()]),
                   AdminFormElement::columns()
                       ->addColumn([
                           AdminFormElement::number('hashrate', 'Хэшрейт')->required()
                       ])
                       ->addColumn([
                           AdminFormElement::text('hashrate_unit', 'Единица измерения хешрейта')->required()
                       ]),
                   AdminFormElement::columns()
                       ->addColumn([AdminFormElement::number('weight', 'Вес')])
                       ->addColumn([AdminFormElement::number('price', 'Цена')]),
                   AdminFormElement::columns()
                       ->addColumn([AdminFormElement::number('in_store_count', 'Кол-во на складе')->setDefaultValue(0)]),
                   AdminFormElement::columns()
                       ->addColumn([AdminFormElement::images('image', 'Изображения')->required()]),
               ])
           )->setLabel('Товар');

           $tabs[] = AdminDisplay::tab(
               new FormElements([
                   AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::textarea('info.warranty', 'Гарантия')->required(),
                        AdminFormElement::textarea('info.notes', 'Заметки к товару'),
                        AdminFormElement::textarea('info.overview', 'Общее описание'),
                        AdminFormElement::textarea('info.payment', 'Правила оплаты'),
                    ])
               ])
           )->setLabel('Дополнительная информация');

           return $tabs;
        });

        return AdminForm::panel()->addBody($tabs);
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        return $this->onEdit(null, $payload);
    }

    /**
     * @return bool
     */
    public function isDeletable(Model $model)
    {
        return true;
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
