<?php

namespace mrugeshtatvasoft\DataTables\Html\Tests;

use mrugeshtatvasoft\DataTables\Html\Builder;
use mrugeshtatvasoft\DataTables\Html\Column;
use PHPUnit\Framework\Attributes\Test;

class BuilderOptionsTest extends TestCase
{
    #[Test]
    public function it_has_callbacks_options()
    {
        $builder = $this->getHtmlBuilder();

        $builder
            ->createdRow('function() {}')
            ->drawCallback('function() {}')
            ->footerCallback('function() {}')
            ->formatNumber('function() {}')
            ->headerCallback('function() {}')
            ->infoCallback('function() {}')
            ->initComplete('function() {}')
            ->preDrawCallback('function() {}')
            ->rowCallback('function() {}')
            ->stateLoadCallback('function() {}')
            ->stateLoaded('function() {}')
            ->stateLoadParams('function() {}')
            ->stateSaveCallback('function() {}')
            ->stateSaveParams('function() {}');

        $this->assertEquals('function() {}', $builder->getAttribute('createdRow'));
        $this->assertEquals('function() {}', $builder->getAttribute('drawCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('footerCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('formatNumber'));
        $this->assertEquals('function() {}', $builder->getAttribute('infoCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('preDrawCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('stateLoaded'));
        $this->assertEquals('function() {}', $builder->getAttribute('stateSaveCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('stateSaveParams'));

        $builder->drawCallbackWithLivewire();
        $this->assertStringContainsString('window.livewire.rescan()', $builder->getAttribute('drawCallback'));

        $builder->drawCallbackWithLivewire('test livewire');
        $this->assertStringContainsString('test livewire', $builder->getAttribute('drawCallback'));
    }

    #[Test]
    public function it_has_columns_options()
    {
        $builder = $this->getHtmlBuilder();

        $builder->columnDefs(['target' => [1]])
            ->addColumnDef(['target' => [1]])
            ->addColumnDef(['target' => [2]])
            ->columns([
                Column::make('id'),
                Column::make('name'),
            ]);

        $this->assertEquals([1], $builder->getAttribute('columnDefs')['target']);
        $this->assertEquals([1], $builder->getAttribute('columnDefs')[0]['target']);
        $this->assertEquals([2], $builder->getAttribute('columnDefs')[1]['target']);
        $this->assertCount(2, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[0]);
        $this->assertEquals('id', $builder->getColumns()[0]['data']);
        $this->assertEquals('id', $builder->getColumns()[0]['name']);
        $this->assertEquals('Id', $builder->getColumns()[0]['title']);

        $builder->addColumn(['data' => 'email']);

        $this->assertCount(3, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[2]);
        $this->assertEquals('email', $builder->getColumns()[2]['data']);
        $this->assertEquals('email', $builder->getColumns()[2]['name']);
        $this->assertEquals('Email', $builder->getColumns()[2]['title']);

        $builder->addColumn(Column::make('created_at'));

        $this->assertCount(4, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[3]);
        $this->assertEquals('created_at', $builder->getColumns()[3]['data']);
        $this->assertEquals('created_at', $builder->getColumns()[3]['name']);
        $this->assertEquals('Created At', $builder->getColumns()[3]['title']);

        $builder->addColumnBefore(['data' => 'updated_at']);

        $this->assertCount(5, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[0]);
        $this->assertEquals('updated_at', $builder->getColumns()[0]['data']);
        $this->assertEquals('updated_at', $builder->getColumns()[0]['name']);
        $this->assertEquals('Updated At', $builder->getColumns()[0]['title']);

        $builder->addBefore(Column::make('deleted_at'));

        $this->assertCount(6, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[0]);
        $this->assertEquals('deleted_at', $builder->getColumns()[0]['data']);
        $this->assertEquals('deleted_at', $builder->getColumns()[0]['name']);
        $this->assertEquals('Deleted At', $builder->getColumns()[0]['title']);

        $builder->removeColumn('created_at', 'updated_at');
        $this->assertCount(4, $builder->getColumns());
    }

    #[Test]
    public function it_has_ajax_options()
    {
        $builder = $this->getHtmlBuilder();

        $builder->postAjax('/test');

        $this->assertEquals('/test', $builder->getAjaxUrl());
        $this->assertEquals([
            'url' => '/test',
            'type' => 'POST',
            'headers' => [
                'X-HTTP-Method-Override' => 'GET',
            ],
        ], $builder->getAjax());

        $builder->ajax('/test');
        $this->assertEquals('/test', $builder->getAjaxUrl());

        $builder->ajax(['url' => '/test']);
        $this->assertEquals('/test', $builder->getAjax('url'));

        $builder->pipeline('/test');
        $this->assertEquals("$.fn.dataTable.pipeline({ url: '/test', pages: 5 })", $builder->getAjaxUrl());

        $builder->pipeline('/test', 6);
        $this->assertEquals("$.fn.dataTable.pipeline({ url: '/test', pages: 6 })", $builder->getAjaxUrl());

        $builder->ajaxWithForm('/test', '#formId');
        $this->assertStringContainsString('data.columns.length', $builder->getAjax()['data']);
        $this->assertStringContainsString('delete data.columns[i].search;', $builder->getAjax('data'));
        $this->assertStringContainsString('#formId', $builder->getAjax('data'));

        $builder->minifiedAjax('/test', 'custom_script', ['id' => 123, 'name' => 'mrugeshtatvasoft']);
        $this->assertEquals('/test', $builder->getAjax('url'));
        $this->assertStringContainsString('custom_script', $builder->getAjax('data'));
        $this->assertStringContainsString('data.id = 123', $builder->getAjax('data'));
        $this->assertStringContainsString("data.name = 'mrugeshtatvasoft'", $builder->getAjax('data'));

        $builder->postAjaxWithForm('/test', '#formId');
        $this->assertStringContainsString('find("input, select, textarea").serializeArray()', $builder->getAjax()['data']);
        $this->assertStringContainsString('#formId', $builder->getAjax('data'));
    }

    #[Test]
    public function it_has_features_options()
    {
        $builder = $this->getHtmlBuilder();
        $builder->autoWidth()
            ->deferRender()
            ->info()
            ->lengthChange()
            ->ordering()
            ->processing()
            ->scrollX()
            ->scrollY()
            ->paging()
            ->searching()
            ->serverSide()
            ->stateSave();

        $this->assertEquals(true, $builder->getAttribute('autoWidth'));
        $this->assertEquals(true, $builder->getAttribute('deferRender'));
        $this->assertEquals(true, $builder->getAttribute('info'));
        $this->assertEquals(true, $builder->getAttribute('lengthChange'));
        $this->assertEquals(true, $builder->getAttribute('ordering'));
        $this->assertEquals(true, $builder->getAttribute('processing'));
        $this->assertEquals(true, $builder->getAttribute('scrollX'));
        $this->assertEquals(true, $builder->getAttribute('scrollY'));
        $this->assertEquals(true, $builder->getAttribute('paging'));
        $this->assertEquals(true, $builder->getAttribute('searching'));
        $this->assertEquals(true, $builder->getAttribute('serverSide'));
        $this->assertEquals(true, $builder->getAttribute('stateSave'));

        $builder->scrollY('50vh');
        $this->assertEquals('50vh', $builder->getAttribute('scrollY'));
    }

    #[Test]
    public function it_has_internationalisation_options()
    {
        $builder = $this->getHtmlBuilder();

        $builder->language('/language-url')
            ->languageDecimal(',')
            ->languageEmptyTable('languageEmptyTable')
            ->languageInfo('languageInfo')
            ->languageInfoEmpty('languageInfoEmpty')
            ->languageInfoFiltered('languageInfoFiltered')
            ->languageInfoPostFix('languageInfoPostFix')
            ->languageLengthMenu('languageLengthMenu')
            ->languageLoadingRecords('languageLoadingRecords')
            ->languageProcessing('languageProcessing')
            ->languageSearch('languageSearch')
            ->languageSearchPlaceholder('languageSearchPlaceholder')
            ->languageThousands('languageThousands')
            ->languageZeroRecords('languageZeroRecords');

        $this->assertEquals('/language-url', $builder->getAttribute('language')['url']);
        $this->assertEquals(',', $builder->getLanguage('decimal'));
        $this->assertEquals('languageEmptyTable', $builder->getLanguage('emptyTable'));
        $this->assertEquals('languageInfo', $builder->getLanguage('info'));
        $this->assertEquals('languageInfoEmpty', $builder->getLanguage('infoEmpty'));
        $this->assertEquals('languageInfoFiltered', $builder->getLanguage('infoFiltered'));
        $this->assertEquals('languageInfoPostFix', $builder->getLanguage('infoPostFix'));
        $this->assertEquals('languageLengthMenu', $builder->getLanguage('lengthMenu'));
        $this->assertEquals('languageLoadingRecords', $builder->getLanguage('loadingRecords'));
        $this->assertEquals('languageProcessing', $builder->getLanguage('processing'));
        $this->assertEquals('languageSearch', $builder->getLanguage('search'));
        $this->assertEquals('languageSearchPlaceholder', $builder->getLanguage('searchPlaceholder'));
        $this->assertEquals('languageThousands', $builder->getLanguage('thousands'));
        $this->assertEquals('languageZeroRecords', $builder->getLanguage('zeroRecords'));

        $builder->languageUrl('languageUrl');
        $this->assertEquals('languageUrl', $builder->getLanguage('url'));
    }

    #[Test]
    public function it_has_plugin_attribute_getter()
    {
        $builder = $this->getHtmlBuilder();

        $builder->selectStyleSingle();

        $this->assertEquals(Builder::SELECT_STYLE_SINGLE, $builder->getPluginAttribute('select', 'style'));
    }

    #[Test]
    public function it_has_options()
    {
        $builder = $this->getHtmlBuilder();
        $builder->deferLoading(10)
            ->destroy(true)
            ->displayStart(1)
            ->dom('Bf')
            ->lengthMenu()
            ->orders([[1, 'asc']])
            ->orderCellsTop()
            ->orderClasses()
            ->orderBy(2)
            ->orderBy(3, 'asc')
            ->orderByFixed(3, 'asc')
            ->orderMulti()
            ->pageLength()
            ->pagingType()
            ->renderer()
            ->retrieve()
            ->rowId()
            ->scrollCollapse()
            ->search([])
            ->searchCols([])
            ->searchDelay(10)
            ->stateDuration(10)
            ->stripeClasses(['stripeClasses'])
            ->tabIndex(2);

        $this->assertEquals(10, $builder->getAttribute('deferLoading'));
        $this->assertEquals(true, $builder->getAttribute('destroy'));
        $this->assertEquals(1, $builder->getAttribute('displayStart'));
        $this->assertEquals('Bf', $builder->getAttribute('dom'));
        $this->assertEquals([10, 25, 50, 100], $builder->getAttribute('lengthMenu'));
        $this->assertEquals([1, 'asc'], $builder->getAttribute('order')[0]);
        $this->assertEquals([2, 'desc'], $builder->getAttribute('order')[1]);
        $this->assertEquals([3, 'asc'], $builder->getAttribute('order')[2]);
        $this->assertEquals(false, $builder->getAttribute('orderCellsTop'));
        $this->assertEquals(true, $builder->getAttribute('orderClasses'));
        $this->assertEquals([[3, 'asc']], $builder->getAttribute('orderFixed'));
        $this->assertEquals(true, $builder->getAttribute('orderMulti'));
        $this->assertEquals(10, $builder->getAttribute('pageLength'));
        $this->assertEquals('simple_numbers', $builder->getAttribute('pagingType'));
        $this->assertEquals('bootstrap', $builder->getAttribute('renderer'));
        $this->assertEquals(false, $builder->getAttribute('scrollCollapse'));
        $this->assertEquals([], $builder->getAttribute('search'));
        $this->assertEquals([], $builder->getAttribute('searchCols'));
        $this->assertEquals(10, $builder->getAttribute('searchDelay'));
        $this->assertEquals(10, $builder->getAttribute('stateDuration'));
        $this->assertEquals(['stripeClasses'], $builder->getAttribute('stripeClasses'));
        $this->assertEquals(2, $builder->getAttribute('tabIndex'));
    }
}
