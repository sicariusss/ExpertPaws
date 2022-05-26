<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Контакты
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Связаться с нами
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-lg-3">
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-share-nodes"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Contacts",
    data() {
        return {
            emails: [],
            phones: [],
            socials: [],
        }
    },
    mounted() {
        let app = this;
        axios.get('api/contacts')
            .then(function (response) {
                app.emails = response.data.emails;
                app.phones = response.data.phones;
                app.socials = response.data.socials;
                console.log(app.emails)
                console.log(app.phones)
                console.log(app.socials)
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>

<style>
.contact-box {
    color: #444444;
    padding: 20px;
    width: 100%;
    background: rgba(255, 255, 255, 0.08);
}

.box-icon {
    color: #ffc60b;
    border-radius: 50%;
    padding: 1rem;
    float: left;
    background: rgba(255, 255, 255, 0.1);
    width: 55px;
    height: 55px;
    text-align: center;
}

.box-icon svg {
    vertical-align: text-bottom;
    width: 20px;
    height: 20px;
}
</style>
