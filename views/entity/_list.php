<div class="row">
    <div class="col-items col-items-image col-xs-8 col-sm-5 col-md-4 col-lg-4">
        <div class="thumbnail">
            <img src="<?= '/img/' . $item['image'] ?>" alt="<?= $item['name'] ?>" title="<?= $item['name'] ?>">
        </div>
    </div>
    <div class="col-items col-items-info col-xs-8 col-sm-7 col-md-8 col-lg-8">
        <div class="caption">
            <h3><?= $item['name'] ?></h3>
            <?php if ($item['type'] == \app\models\Music::TYPE
                && !empty($item['artist'])
            ) : ?>
                <p>Исполнитель - <i><?= $item['artist'] ?></i></p>
            <?php endif; ?>
            <?php if ($item['type'] != \app\models\Event::TYPE) : ?>
                <?php if ($item['releaseDate']) : ?>
                    <p>Дата выхода - <?= $item['releaseDate'] ?></p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($item['type'] == \app\models\Event::TYPE) : ?>
                <?php if ($item['location']) : ?>
                    <p>Место - <i><?= $item['location'] ?><i></p>
                <?php endif; ?>
                <?php if ($item['startDate'] && $item['endDate']) : ?>
                    <p><?= $item['startDate'] ?> - <?= $item['endDate'] ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>