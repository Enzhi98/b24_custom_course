<?php

namespace B24\Academy\UI\Menu;

use Bitrix\Main\Context;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;

class LeftMenuExtender
{
    public static function handleOnEpilog(): void
    {
        if (Context::getCurrent()->getRequest()->isAdminSection()) {
            return;
        }
        Extension::load('b24.academy.menu.left');

        Asset::getInstance()->addString(
            <<<HTML
            <script>
            BX.ready(function () {                
                const extraBtnBox = document.querySelector('.menu-extra-btn-box');
                if (extraBtnBox === null) {
                    console.warn('Extra btn box is missing.');
                    return;
                }
                const menuItem = document.createElement('div');
                menuItem.id = 'companyFactMenuItem';
                menuItem.innerText = 'Факты о компании';
                menuItem.onclick = BX.b24.academy.menu.left.showFacts;
                menuItem.style.color = '#eaeff8';
                menuItem.style.cursor = 'pointer';
                extraBtnBox.parentNode.insertBefore(menuItem, extraBtnBox);
            });
            </script>
            HTML
        );
    }
}
