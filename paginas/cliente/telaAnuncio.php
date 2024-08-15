<?php
include '../../padroes/head.php';
?>

<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/locales-all.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Adiciona o SweetAlert2 -->
    <link rel="stylesheet" href="/projAxeySenai/assets/css/style.css">

    <style>
        /* Estilo do Modal */
        .modal {
            display: none;
            /* Inicialmente escondido */
            position: fixed;
            z-index: 1050;
            /* Bootstrap z-index */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-backdrop.show {
            opacity: 0;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            /* Ajustado para melhor centralização */
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 800px;
            height: 90%;
            /* Ajuste da altura do modal */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #calendar {
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
            overflow: hidden;
            /* Evitar rolagem na página principal */
        }

        /* Estilo do formulário no pop-up */
        .popup-form {
            display: none;
            position: fixed;
            z-index: 1060;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #888;
            width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        textarea {
            resize: none;
            height: 100px;
        }

        a {
            text-decoration: none;
            color: #012640;
        }
    </style>
</head>

<body class="bodyCards">
    <?php include '../../padroes/nav.php'; ?>


    <div class="py-3">
        <div class="main container d-flex flex-column flex-md-row">
            <div id="separa-divs">

                <div id="carouselExampleAutoplaying" class="carousel slide teste" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../../assets/imgs/imgTeste.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../../assets/imgs/imgTeste.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../../assets/imgs/imgTeste.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"></span>
                    </button>
                </div>
            </div>

            <div class="main-group-func container flex-wrap object-fit d-flex align-self-center">
                <div class="icon img-fluid container altera-img d-flex justify-content-center">
                    <img src="../../assets/imgs/user.png" alt="" class="rounded-circle teste">

                </div>
                <div class="legenda container text-center mb-3">
                    <p>illum quae eligendi unde ipsa reiciendis dolor assumenda voluptates recusandae animi nesciunt
                        earum laboriosam.</p>
                </div>

                <div class="buttom-gourp d-flex flex-column container text-center">
                    <a href="../prestador/TelaPerfilPrestador.php" type="submit"
                        class="btn btn-success"><span></span>Entre em contato</a>
                    <div class="group-buttom d-flex flex-column py-2">
                        <button type="button" id='show-calendar' class="btn btn-primary botaoVerificaDisponibilidade"
                            data-toggle="modal" data-target="#calendarModal">
                            <i class="fa-regular fa-calendar"></i> Verificar Disponibilidade </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id='calendarModal' class='modal'>
        <div class='modal-content'>
            <span class='close'>&times;</span>
            <div id='calendar'></div>
        </div>
    </div>

    <div id="popupForm" class="popup-form">
        <h3>Serviço</h3>
        <form id="serviceForm">
            <div class="mb-3">
                <label for="serviceDate" id="dateLabel" class="form-label">Datas Selecionadas</label>
                <input type="text" id="serviceDate" name="serviceDate" class="form-control" readonly>
            </div>
            <div class="row mb-3" id="timeEditableFields">
                <div class="col">
                    <label for="eventHoraInicio" class="form-label">Hora Início</label>
                    <input type="time" id="eventHoraInicio" name="eventHoraInicio" class="form-control">
                </div>
                <div class="col" id="horaFimContainer">
                    <label for="eventHoraFim" class="form-label">Hora Fim</label>
                    <input type="time" id="eventHoraFim" name="eventHoraFim" class="form-control">
                </div>
            </div>
            <div class="row mb-3" id="timeDisplayFields" style="display: none;">
                <div class="col">
                    <label for="startTimeDisplay" class="form-label">Hora Início (Visualizar)</label>
                    <input type="text" id="startTimeDisplay" name="startTimeDisplay" class="form-control" readonly>
                </div>
                <div class="col">
                    <label for="endTimeDisplay" class="form-label">Hora Fim (Visualizar)</label>
                    <input type="text" id="endTimeDisplay" name="endTimeDisplay" class="form-control" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="eventTitle" class="form-label">Título</label>
                <input type="text" id="eventTitle" name="eventTitle" class="form-control"
                    placeholder="Digite o título do serviço">
            </div>
            <div class="mb-3">
                <label for="eventDesc" class="form-label">Descrição</label>
                <textarea id="eventDesc" name="eventDesc" class="form-control"
                    placeholder="Digite a descrição do serviço"></textarea>
            </div>
            <div class="mb-3">
                <label for="repeatDays" class="form-label">Deseja repetir?</label>
                <div id="repeatDays" class="d-flex flex-wrap">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="dayMon" value="1">
                        <label class="form-check-label" for="dayMon">Seg</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="dayTue" value="2">
                        <label class="form-check-label" for="dayTue">Ter</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="dayWed" value="3">
                        <label class="form-check-label" for="dayWed">Qua</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="dayThu" value="4">
                        <label class="form-check-label" for="dayThu">Qui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="dayFri" value="5">
                        <label class="form-check-label" for="dayFri">Sex</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="daySat" value="6">
                        <label class="form-check-label" for="daySat">Sáb</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="daySun" value="7">
                        <label class="form-check-label" for="daySun">Dom</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" id="saveEvent" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-secondary close-popup">Fechar</button>
            </div>
        </form>
    </div>
    <div class="services-container-wrapper container containerCards">
        <div class="tituloServicos">
            <h1 class="titulo">Serviços em destaque</h1>
        </div>
        <button class="arrow fechaEsquerda flecha" onclick="scrollCards('.container1', -1)">&#9664;</button>
        <div class="services-container container1 containerServicos">
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 1</h5>
                    <p class="card-text">Descrição breve do Serviço 1.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 2</h5>
                    <p class="card-text">Descrição breve do Serviço 2.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 3</h5>
                    <p class="card-text">Descrição breve do Serviço 3.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 4</h5>
                    <p class="card-text">Descrição breve do Serviço 4.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 5</h5>
                    <p class="card-text">Descrição breve do Serviço 5.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 6</h5>
                    <p class="card-text">Descrição breve do Serviço 6.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 7</h5>
                    <p class="card-text">Descrição breve do Serviço 7.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
            <div class="card cardServicos">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Serviço 8</h5>
                    <p class="card-text">Descrição breve do Serviço 8.</p>
                    <a href="paginas/cliente/telaAnuncio.php" class="btn btn-primary btnSaibaMais">Saiba mais</a>
                </div>
            </div>
        </div>
        <button class="arrow flechaDireita flecha" onclick="scrollCards('.container1', 1)">&#9654;</button>
    </div>
    <?php include '../../padroes/footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var userState = 0; // Estado do usuário: 0 para editar, 1 para visualizar
            var commercialStartHour = "09:00";
            var commercialEndHour = "18:00";

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '2024-08-12', // Definindo a data inicial
                locale: 'pt-br',
                height: '100%',
                editable: true,
                headerToolbar: {
                    start: 'dayGridMonth',
                    center: 'title',
                    end: 'prevYear,prev,next,nextYear'
                },
                eventColor: 'green',
                events: [
                    {
                        title: 'All Day Event',
                        start: '2024-08-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2024-08-07',
                        end: '2024-08-10'
                    },
                    {
                        title: 'Conference',
                        start: '2024-08-11',
                        end: '2024-08-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2024-08-12T10:30:00',
                        end: '2024-08-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2024-08-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2024-08-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2024-08-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2024-08-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2024-08-13T07:00:00'
                    },
                    {
                        title: 'Vacation',
                        start: '2024-08-13',
                        end: '2024-08-17'
                    }
                ],
                selectable: true,
                select: function (info) {
                    var startDate = new Date(info.start);
                    var endDate = new Date(info.end);

                    // Formatar as datas no formato YYYY-MM-DD
                    var formattedStartDate = startDate.toISOString().split('T')[0];
                    var formattedEndDate = new Date(endDate.getTime() - 86400000).toISOString().split('T')[0];

                    // Verificar se o usuário está no modo de edição (0) ou visualização (1)
                    if (userState === 0) {
                        // Verificar se os elementos existem
                        if (document.getElementById('serviceDate') && document.getElementById('timeEditableFields') && document.getElementById('timeDisplayFields') && document.getElementById('popupForm')) {
                            // Definir a data no input do formulário
                            document.getElementById('serviceDate').value = formattedStartDate + " - " + formattedEndDate;

                            // Exibir os campos de hora editáveis e esconder os campos de visualização
                            document.getElementById('timeEditableFields').style.display = 'block';
                            document.getElementById('timeDisplayFields').style.display = 'none';

                            // Exibir o formulário pop-up
                            document.getElementById('popupForm').style.display = 'block';
                        }
                    } else if (userState === 1) {
                        Swal.fire({
                            title: 'Detalhes do Serviço',
                            html: `
                        <p><strong>Data:</strong> ${formattedStartDate} - ${formattedEndDate}</p>
                        <p><strong>Hora Início:</strong> 08:00</p>
                        <p><strong>Hora Fim:</strong> 12:00</p>
                        <p><strong>Título:</strong> Meu Título</p>
                        <p><strong>Descrição:</strong> Minha Descrição</p>
                    `,
                            icon: 'info',
                            confirmButtonText: 'Fechar'
                        });
                    }
                }
            });

            // Evento para abrir o calendário no modal
            document.getElementById('show-calendar').addEventListener('click', function () {
                document.getElementById('calendarModal').style.display = 'block';
                calendar.render();
            });

            // Evento para fechar o modal
            document.querySelector('.close').addEventListener('click', function () {
                document.getElementById('calendarModal').style.display = 'none';
            });

            // Evento para fechar o formulário pop-up
            document.querySelector('.close-popup').addEventListener('click', function () {
                document.getElementById('popupForm').style.display = 'none';
            });

            // Função de validação do formulário
            document.getElementById('serviceForm').addEventListener('submit', function (event) {
                event.preventDefault();

                var serviceDate = document.getElementById('serviceDate').value;
                var startTime = document.getElementById('eventHoraInicio').value;
                var endTime = document.getElementById('eventHoraFim').value;
                var title = document.getElementById('eventTitle').value;
                var description = document.getElementById('eventDesc').value;

                var today = new Date().toISOString().split('T')[0];
                var startDate = new Date(serviceDate.split(' - ')[0]);

                if (!serviceDate || !startTime || !endTime || !title || !description) {
                    Swal.fire({
                        title: 'Erro',
                        text: 'Todos os campos devem ser preenchidos.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    });
                    return;
                }

                if (startDate < new Date(today)) {
                    Swal.fire({
                        title: 'Erro',
                        text: 'A data inicial não pode ser menor que a data de hoje.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    });
                    return;
                }

                // Se tudo estiver correto, você pode prosseguir com o envio ou outra lógica
                Swal.fire({
                    title: 'Sucesso',
                    text: 'Serviço salvo com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'Fechar'
                });

                // Fechar o formulário
                document.getElementById('popupForm').style.display = 'none';
            });

            // Inicializar o calendário
            calendar.render();
        });

        function scrollCards(containerSelector, direction) {
            const container = document.querySelector(containerSelector);
            const cardWidth = container.querySelector('.cardServicos').offsetWidth;
            container.scrollBy({
                left: direction * cardWidth,
                behavior: 'smooth'
            });
        }

        function scrollCards2(containerSelector, direction) {
            const container = document.querySelector(containerSelector);
            const cardWidth = container.querySelector('.cardServicos').offsetWidth;
            container.scrollBy({
                left: direction * cardWidth,
                behavior: 'smooth'
            });
        }
    </script>
</body>

</html>