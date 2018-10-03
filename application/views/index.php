<div class="row">
  <div class="col-sm"></div>
  <div class="col-sm">
    <!--
    <form action="/main/index/" method="GET">
      <div class="row">
        <div class="col">
          <div class="input-group">
            <select
              class="custom-select" id="inputGroupSelect04" name="limit">
              <option value="10">10</option>
              <option value="5">5</option>
              </select>
              <div class="input-group-append"><button class="btn btn-outline-secondary" type="submit">Сортировать</button></div>
          </div>
        </div>
      </div>
    </form>
    -->
    <form action="/" method="POST">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check" id="checkAll"> Check All
        </label>
      </div>
      <?php foreach ($data as $item):?>
      <div class="form-group form-check">
        <input class="form-check-input check" type="checkbox" value="<?=$item->getName()?>" name="<?=$item->getId()?>">
        <label class="form-check-label" for="<?=$item->getId()?>">
          <?=$item->getName()?>
        </label>
      </div>
      <?php endforeach?>
      <input class="btn btn-primary" type="submit" value="Submit">
    </form>
  </div>
  <div class="col-sm"></div>
</div>