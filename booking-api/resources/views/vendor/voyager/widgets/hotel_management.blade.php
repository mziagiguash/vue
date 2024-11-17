<div class="panel panel-default">
    <!-- Панель с отелями -->
    <div class="panel-body">
        <h3 class="panel-title">Список отелей</h3>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-center text-xl">
                <span class="font-bold text-primary">{{ $count }}</span> отелей
                <!-- Стиль выделения количества отелей -->
            </div>
            <a href="{{ route('voyager.hotels.index') }}" class="btn btn-primary btn-lg">
                <!-- Кнопка с улучшенным стилем -->
                <i class="voyager-list"></i> Просмотреть все отели
            </a>
        </div>
    </div>
</div>
