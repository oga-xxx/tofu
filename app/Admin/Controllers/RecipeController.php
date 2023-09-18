<?php

namespace App\Admin\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RecipeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Recipe';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Recipe());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'))->image();
        $grid->column('cooking', __('Cooking'));
        $grid->column('score', __('Score'));
        $grid->column('category.name', __('Category Name'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', 'レシピ名');
            $filter->like('cooking', '作り方');
            $filter->between('score', '豆腐感');
            $filter->in('category_id', '置き換え')->multipleSelect(Category::all()->pluck('name', 'id'));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Recipe::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'))->image();
        $show->field('cooking', __('Cooking'));
        $show->field('score', __('Score'));
        $show->field('category.name', __('Category Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Recipe());

        $form->text('name', __('Name'));
        $form->image('image', __('Image'));
        $form->textarea('cooking', __('Cooking'));
        $form->number('score', __('Score'));
        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));

        return $form;
    }
}
