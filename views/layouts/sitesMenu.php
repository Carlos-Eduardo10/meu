<ul class="nav nav-pills p-3 bg-white mb-3 align-items-center">
      <li class="nav-item">
        <a href="/sites" class="
                  nav-link
                  rounded-pill
                  note-link
                  d-flex
                  align-items-center
                  justify-content-center
                  px-3 px-md-3
                  me-0 me-md-2
                  <?= (yii::$app->controller->id === 'sites') ? 'active' : '' ?>
                ">
          <i data-feather="map-pin" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium">Sites</span></a>
      </li>
      <li class="nav-item">
        <a href="/group" class="
                  nav-link
                  rounded-pill
                  note-link
                  d-flex
                  align-items-center
                  justify-content-center
                  px-3 px-md-3
                  me-0 me-md-2
                  <?= (yii::$app->controller->id === 'group') ? 'active' : '' ?>
                ">
          <i data-feather="layers" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium">Grupos</span></a>
      </li>
    </ul>