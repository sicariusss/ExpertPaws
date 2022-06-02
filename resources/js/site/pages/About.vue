<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Информация
            </div>
        </div>
        <div class="row pb-4">
            <div class="component-title-max">
                О нас
            </div>
        </div>
        <div class="about-block mb-5">
            <div class="row justify-content-center align-items-center flex-lg-row-reverse mt-3">
                <div class="col-lg-6 ms-lg-5">
                    <div>
                        <span class="about-color-text">Expert Paws</span> – это образовательная платформа, которая
                        проводит курсы от
                        специалистов в одном месте.
                    </div>
                    <div class="mt-2">
                        Наша <span class="about-color-text">цель</span> – сделать <span class="about-border-text">фелинологическое</span>
                        образование открытым и максимально удобным.
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <img class="about-images" src="/images/about/about-1.jpg" alt="cat-about">
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-lg-5">
                <div class="col-lg-7">
                    <div>
                        Мы проводим фелинологические курсы в режиме <span class="about-color-text">онлайн</span>.
                    </div>
                    <div class="mt-2">
                        <span class="about-border-text">Онлайн-курсы</span> – это практичный и удобный формат обучения.
                    </div>
                    <div class="mt-2">
                        Плюсы <span class="about-color-text">дистанционного обучения</span> в том, что Вы не тратите
                        время
                        на дорогу, стоимость образования ниже, а
                        условия обучения очень комфортные – дома, в любое удобное для Вас время и в компании любимых
                        <span
                            class="about-color-text">котиков</span>.
                    </div>
                </div>
                <div class="col-lg-4">
                    <img class="about-images" src="/images/about/about-2.png" alt="cat-about">
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-lg-5">
                <div class="col-lg-11">
                    <div>
                        После оплаты курса Вы <span class="about-border-text">мгновенно</span> получаете доступ к
                        материалу
                        на сайте.
                        Время обучения <span class="about-border-text">не ограничено</span>.
                        Прямо на <span class="about-color-text">сайте</span> Вы читаете материал и проходите задания.
                        На протяжении всего курса занятий Вы сможете задавать вопросы по материалу <span
                        class="about-color-text">эксперту-фелинологу</span> с многолетним стажем работы.
                    </div>
                    <div class="mt-2">
                        По окончании курса Вы получите сертификат <span class="about-border-text">фелинолога</span>,
                        дающий право на профессиональную деятельность.
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-lg-5">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 d-flex flex-column align-items-center about-edu-item position-relative">
                            <img class="about-edu-image" src="/images/about/about-3.jpg" alt="cat-about">
                            <div class="about-edu-desc">
                                Вы выбираете и покупаете нужный курс
                            </div>
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                        <div class="col-lg-3 d-flex flex-column align-items-center about-edu-item position-relative">
                            <img class="about-edu-image" src="/images/about/about-4.jpg" alt="cat-about">
                            <div class="about-edu-desc">
                                Проходите материал и тесты в любое удобное время
                            </div>
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                        <div class="col-lg-3 d-flex flex-column align-items-center about-edu-item position-relative">
                            <img class="about-edu-image" src="/images/about/about-5.jpg" alt="cat-about">
                            <div class="about-edu-desc">
                                Сдаете итоговый экзамен в дистанционном режиме
                            </div>
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                        <div class="col-lg-3 d-flex flex-column align-items-center about-edu-item position-relative">
                            <img class="about-edu-image" src="/images/about/about-6.png" alt="cat-about">
                            <div class="about-edu-desc">
                                Получаете сертификат о прохождении курсов
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-lg-5">
                <div class="col-lg-11">
                    <div>
                        Наши курсы рассчитаны на те материалы, которые помогут
                        фелинологам
                        <span class="about-border-text">грамотно</span> выполнять свою работу. Материал дается в <span
                        class="about-border-text">простой и понятной форме</span>, с
                        конечными результатами расчетов и их практическом применении при работе с кошачими.
                        Владельцы животных <span class="about-color-text">научатся</span> ориентироваться в мире
                        фелинологии, применять полученные знания на
                        практике, разбираться в особенностях кошек, в их психологии и анатомии. <span
                        class="about-color-text">Знания</span> не бывают
                        лишними, тем более в фелинологии.
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-lg-5">
                <div class="col-lg-11">
                    <div>
                        Остались вопросы? <span class="about-link"><router-link
                        to="/contacts">Свяжитесь с нами!</router-link></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.about-block {
    font-size: 20px;
    color: #fff;
    font-family: "Raleway", sans-serif;
}

.about-block .about-color-text {
    color: #ffc60b;
    font-weight: bold;
}

.about-block .about-link a {
    color: #ffc60b;
    font-weight: bold;
}

.about-block .about-border-text {
    border-bottom: 1px solid #ffc60b;
}

.about-images {
    width: 100%;
    border-radius: 1rem;
}

.about-edu-image {
    width: 70%;
    border-radius: 50%;
    border: 6px solid rgba(255, 255, 255, 0.12);
}

.about-edu-desc {
    margin-top: 1rem;
    font-size: 18px;
    text-align: center;
}

.about-edu-item .fa-angle-right {
    position: absolute;
    margin-top: 30%;
    margin-left: 100%;
    color: #ffc60b;
}

</style>

<script>
export default {
    name: "About",
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>
