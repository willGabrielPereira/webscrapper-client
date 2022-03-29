<?php

use model\File;
use model\History;

return function ($biddings, $app) { ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Licitações</title>

        <style>
            body {
                display: flex;
                flex-wrap: wrap;
                background: #e7e7e7;
                gap: 15px;
            }

            .biddingContainer {
                background: #fff;
                padding: 10px 15px;
                flex: 0 1 100%;
                border-radius: 16px;
                box-shadow: 1px 3px 7px #000000c4;
            }

            .filesContainer {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .file {
                display: flex;
                flex-direction: column;
                background: #e4f2ff;
                padding: 2px 5px;
                border-radius: 8px;
                box-shadow: 1px 3px 4px #bfbfbfc4;
                flex: 1 1 30%;
            }

            .historicalContainer {
                margin-top: 10px;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .history {
                display: flex;
                background: #fffbe4;
                padding: 2px 5px;
                border-radius: 8px;
                flex: 1 1 30%;
                box-shadow: 1px 3px 4px #bfbfbfc4;
                gap: 2px;
            }
        </style>
    </head>

    <body>

        <? foreach ($biddings as $bidding) { ?>

            <div class="biddingContainer">
                <div class="title">
                    <h2><a href="<?= $bidding->url ?>"><?= $bidding->title ?></a></h2>
                    <small><?= $bidding->status ?></small>
                    <small><?= date('d/m/Y H:i', strtotime($bidding->date)) ?></small>
                </div>
                <div class="description">
                    <?= $bidding->description ?>
                </div>

                <div class="filesContainer">
                    <? foreach ((new File($app))->db()->where('bidding_id', $bidding->id)->get() as $file) { ?>
                        <div class="file">
                            <a href="<?= $file->url ?>" title="Tamanho: <?= $file->size ?>"><?= $file->name ?></a> Publicado em: <?= date('d/m/Y H:i', strtotime($file->date)) ?>
                        </div>
                    <? } ?>
                </div>

                <div class="historicalContainer">
                    <? foreach ((new History($app))->db()->where('bidding_id', $bidding->id)->get() as $history) { ?>
                        <div class="history">
                            <span><?= date('d/m/Y H:i', strtotime($history->date)) ?></span>
                            <span><?= $history->status ?></span>
                            <span><?= $history->reason ?></span>
                        </div>
                    <? } ?>
                </div>
            </div>
        <? } ?>
    </body>

    </html>
<? } ?>