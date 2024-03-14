<?$router = \Bitrix\Main\Application::getInstance()->getRouter();?>
<div class="menu-lk-main">
    <div class="menu-lk-wrapper">
        <ul class="menu-lk">
            <?
            $NameRoute = 'personal/account';
            $route = \Bxx\Helpers\Routs::getRoute($NameRoute);?>
            <li class="menu-lk-item <?if(\Bxx\Helpers\Routs::isCurrent($route)):?>menu-lk-item--active<?endif?>">
                <a href="<?=$router->route($NameRoute);?>" class="menu-lk-item__link">
                    <div class="menu-lk-item__icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 21C16.5228 21 21 16.5228 21 11C21 5.47715 16.5228 1 11 1C5.47715 1 1 5.47715 1 11C1 16.5228 5.47715 21 11 21Z"
                                stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M10.9992 12.2444C12.7235 12.2444 14.1214 10.8466 14.1214 9.12222C14.1214 7.39787 12.7235 6 10.9992 6C9.27482 6 7.87695 7.39787 7.87695 9.12222C7.87695 10.8466 9.27482 12.2444 10.9992 12.2444Z"
                                stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M17.3451 18.7333C15.7563 17.0556 13.5007 16 11.0007 16C8.50069 16 6.25625 17.0556 4.65625 18.7333"
                                stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="menu-lk-item__text">
                        My account
                    </div>
                </a>
            </li>
            <?/*
            $NameRoute = 'personal/account/info';
            $route = \Bxx\Helpers\Routs::getRoute($NameRoute);?>
            <li class="menu-lk-item <?if(\Bxx\Helpers\Routs::isCurrent($route)):?>menu-lk-item--active<?endif?>">
                <a href="<?=$router->route($NameRoute);?>" class="menu-lk-item__link">
                    <div class="menu-lk-item__icon">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_141_6676)">
                                <path d="M13.75 16.75H16.75C18.41 16.75 19.75 15.41 19.75 13.75V3.75C19.75 2.09 18.41 0.75 16.75 0.75H4.75C3.09 0.75 1.75 2.09 1.75 3.75V6.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M5.75 13.75C7.13071 13.75 8.25 12.6307 8.25 11.25C8.25 9.86929 7.13071 8.75 5.75 8.75C4.36929 8.75 3.25 9.86929 3.25 11.25C3.25 12.6307 4.36929 13.75 5.75 13.75Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M9.75 6.75H14.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M11.75 10.75H14.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M10.75 18.75C10.75 17.37 9.63 16.25 8.25 16.25H3.25C1.87 16.25 0.75 17.37 0.75 18.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_141_6676">
                                    <rect width="20.5" height="19.5" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="menu-lk-item__text">
                        Account information
                    </div>
                </a>
            </li>
            <?/** */
            $NameRoute = 'personal/orders';
            $route = \Bxx\Helpers\Routs::getRoute($NameRoute);?>
            <li class="menu-lk-item <?if(\Bxx\Helpers\Routs::isCurrent($route)):?>menu-lk-item--active<?endif?>">
                <a href="<?=$router->route($NameRoute);?>" class="menu-lk-item__link">
                    <div class="menu-lk-item__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_141_6682)">
                                <path
                                    d="M2.75 14.75V2.33C2.75 1.97 2.94 1.64 3.25 1.46L4.24 0.879995C4.55 0.699995 4.93 0.699995 5.24 0.879995L6.74 1.74C6.74 1.74 7.65 1.21 8.23 0.879995C8.54 0.699995 8.92 0.699995 9.23 0.879995L10.73 1.74L12.23 0.879995C12.54 0.699995 12.92 0.699995 13.23 0.879995L14.72 1.74L16.22 0.879995C16.53 0.699995 16.91 0.699995 17.22 0.879995L18.21 1.46C18.52 1.64 18.71 1.97 18.71 2.33V17.25C18.71 18.08 18.04 18.75 17.21 18.75C16.38 18.75 15.71 18.08 15.71 17.25V15.75C15.71 15.2 15.26 14.75 14.71 14.75H1.75C1.2 14.75 0.75 15.2 0.75 15.75V16.75C0.75 17.85 1.65 18.75 2.75 18.75H17.25"
                                    stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M10.75 10.25H6.75" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10.75 6.75H6.75" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.75 10.25H13.75" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.75 6.75H13.75" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_141_6682">
                                    <rect width="19.5" height="19.5" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="menu-lk-item__text">
                        Order & Returns
                    </div>
                </a>
            </li>
            <?
            $NameRoute = 'personal/contact';
            $route = \Bxx\Helpers\Routs::getRoute($NameRoute);?>
            <li class="menu-lk-item <?if(\Bxx\Helpers\Routs::isCurrent($route)):?>menu-lk-item--active<?endif?>">
                <a href="<?=$router->route($NameRoute);?>" class="menu-lk-item__link">
                    <div class="menu-lk-item__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_141_6661)">
                                <path
                                    d="M16.2491 5.99998L13.6091 3.61998C12.6591 2.75998 11.2091 2.75998 10.2591 3.61998L7.61914 5.99998"
                                    stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M18 13.28V7C18 6.45 17.55 6 17 6H7C6.45 6 6 6.45 6 7V13.28"
                                    stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8.74984 15.25L3.58984 20.41" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.25 15.25L20.41 20.41" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 10H14" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M11 13H13" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M3 10.85V20C3 20.55 3.45 21 4 21H20C20.55 21 21 20.55 21 20V10.85"
                                    stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M5.99985 7.57996C5.99985 7.57996 4.39985 9.01996 3.32985 9.98996C2.84985 10.43 2.89985 11.2 3.43985 11.56L10.8799 16.56C11.5499 17.01 12.4298 17.02 13.1098 16.56C14.9798 15.3 18.7299 12.79 20.5599 11.55C21.0999 11.19 21.1499 10.42 20.6699 9.97996L17.9999 7.57996"
                                    stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_141_6661">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="menu-lk-item__text">
                        Contact Preferences
                    </div>
                </a>
            </li>
            <li class="menu-lk-item menu-lk-item--sign">
                <a href="/?logout=yes&<?=bitrix_sessid_get()?>" class="menu-lk-item__link">
                    <div class="menu-lk-item__icon">

                    </div>
                    <div class="menu-lk-item__text">
                        Sign Out
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>