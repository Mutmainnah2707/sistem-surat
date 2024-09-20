<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <ul class="navbar-nav ml-auto">

        <!-- Notifications -->
        <li class="nav-item dropdown no-arrow mx-1">

            <!-- Count -->
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <?php if ($countIsRead > 0): ?>
                    <span class="badge badge-danger badge-counter"><?= $countIsRead ?></span>
                <?php endif; ?>
            </a>

            <!-- Dropdown -->
            <?php if ($incomingLetterNotifications): ?>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Surat Masuk
                    </h6>

                    <?php foreach ($incomingLetterNotifications as $incomingLetterNotification): ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?= site_url('surat-masuk/show/' . $incomingLetterNotification['letter_id']) ?>">
                            <div class="dropdown-list-image mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate"><?= $incomingLetterNotification['subject']; ?></div>
                                <div class="small text-gray-500"><?= $incomingLetterNotification['sender'] ?> · <?= date('d M Y · H:i', strtotime($incomingLetterNotification['received_date'])) ?></div>
                            </div>
                        </a>
                    <?php endforeach ?>

                    <a class="dropdown-item text-center small text-gray-500" href="#">Lihat semua</a>
                </div>
            <?php endif ?>

        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- User Information -->
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= user()->name ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('assetAdmin/img/undraw_profile.svg') ?>">
            </a>

            <!-- Dropdown -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= site_url('settings') ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>

        </li>

    </ul>

</nav>