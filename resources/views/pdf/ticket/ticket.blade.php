<template>
    <div class="pdf-print" id="pdf-print">
        <header class="header">
            <div class="logo">
                <img src="/design/img/logo/logo.svg" width="200" height="" alt="CXID OPERA">
                Електронний квиток
            </div>
            <div class="barcode">
                <img src="data:image/png;base64, {!! \DNS1D::getBarcodePNG($order->id . '-' . $ticket->id, "C39") !!} " alt="barcode" />
            </div>
        </header>
        <div class="info-wrap">
            <section class="info">
                <h2 class="info-title">Роздрукуйте і пред'явіть весь лист на вході</h2>
                <p>Данный штрих-ко может быть использован только один раз.</p>
                <p>Не передавайте содержимое данного билета третьим лицам.</p>
                <p>Это может стать причиной того, что Вы не сможете осуществить вход на мероприятие.</p>
                <p>За сохранность данных продавец ответственности не несет.</p>
            </section>
            <section class="contacts">
                <h2 class="contacts-title">Контакты:</h2>
                <p>097 000 70 40</p>
            </section>
        </div>
        <section class="rules">
            <header class="rules-header">
                <p>Данный билет является входным и не подлежит обмену</p>
                <small>Обмен: Электронный билет является входным</small>
            </header>
            <p class="rules-title">Правила пребывания на мероприятии:</p>
            <ol class="rules-list">
                <li>Входной билет установленного вида является гарантией Вашего входа на мероприятие.</li>
                <li>Деньги за билет могут быть возвращены организатором лишь при условии наличия билета и только в случае отмены мероприятия. При осуществлении возврата билета, организатором производится возврат номинальной стоимости возвращаемого билета, комиссионный сбор возврата не подлежит.</li>
                <li>Посетители, которые нарушают данные Правила и не подчиняются требованиям официальных лиц, будут выведены за территорию проведения мероприятия без компенсации стоимости билета.</li>
            </ol>
        </section>

        <section class="ticket">
            <div class="ticket-main">
                <header>
                    <div class="logo"><img src="/design/img/logo/logo.svg" width="200" alt="CXID OPERA"></div>
                    <div class="barcode">
                        <img src="data:image/png;base64, {!! \DNS1D::getBarcodePNG($order->id . '-' . $ticket->id, "C39") !!} " alt="barcode" />
                    </div>
                </header>
                <div class="ticket-info">
                    <div class="ticket-left">
                        <h2 class="ticket-name">{{ $ticket->performanceCalendar->performance->translate->title }}</h2>
                        <time class="ticket-date">{{ \Jenssegers\Date\Date::parse($ticket->performanceCalendar->date)->format('j F Y H:i') }}</time>
                        <p class="ticket-hall">{{ $ticket->seatPrice->seat->row->section->hall->translate->title }}</p>
                        <p class="ticket-place">
                            {{ $ticket->seatPrice->seat->row->section->translate->title }},
                            ряд: {{ $ticket->seatPrice->seat->row->number }},
                            место: {{ $ticket->seatPrice->seat->number }}
                        </p>
                    </div>
                    <div class="ticket-right">
                        <p class="ticket-cost">Стоимость билета: <span>{{ $ticket->seatPrice->priceZone->price }} грн.</span></p>
                        <p class="ticket-buyer">Покупатель: <span>{{ $order->buyer->email ?? $order->email }}</span></p>
                    </div>
                </div>
                <footer>
                    <div class="ticket-number">
                        Номер билета: <span>{{ $order->id }}-{{ $ticket->id }}</span>
                    </div>
                    <small class="ticket-site">{{ route('front.home') }}</small>
                </footer>
            </div>
            <div class="ticket-spine">
                <div class="barcode">
                    <img src="data:image/png;base64, {!! \DNS1D::getBarcodePNG($order->id . '-' . $ticket->id, "C39") !!} " alt="barcode" />
                </div>
                <div class="ticket-number">
                    Номер билета: <span>{{ $order->id }}-{{ $ticket->id }}</span>
                </div>
            </div>
        </section>
        <p class="copyright">&copy; 2019-2019 "CXID OPERA". Все права защищены</p>
    </div>
</template>

