<template>
    <MountingPortal
        mountTo="#notification-compo">
        <div class="dropdown ml-1">
            <button aria-expanded="false" aria-haspopup="true"
                    class="btn btn-secondary dropdown-toggle btn-primary-outline" data-toggle="dropdown"
                    id="dropdownMenu2"
                    style="background-color: transparent;border-color: transparent; box-shadow: none;" type="button"
                    v-on:click="resetCounter">
                <i aria-hidden="true" class="fa fa-bell" style="color:#717d88"></i><span class="badge badge-success">{{count}}</span>
            </button>

            <div aria-labelledby="dropdownMenu2" class="dropdown-menu">
                <template v-if="notificationList.length">
                    <li class="dropdown-item" v-for="notification in notificationList">
                        <a :href="notification.url">{{ notification.message }}</a>
                    </li>
                </template>
                <template v-else>
                    <li class="dropdown-item">
                        No notification!
                    </li>
                </template>
            </div>
        </div>
    </MountingPortal>
</template>

<script>
    export default {
        name: "NotificationComponent",
        props: ["user", "notif"],
        data() {
            return {
                count: 0,
                notificationList: []
            }
        },
        created() {
            window.Echo.private(`blog.add.new`)
                .listen('BlogAdded', (e) => {
                    if (e.blog) {
                        this.count = this.count + 1;
                        this.playSound(this.notif);
                        this.notificationList.push(e.blog);
                    }
                });
        },
        methods: {
            resetCounter() {
                this.count = 0
            },
            playSound(sound) {
                if (sound) {
                    let audio = new Audio(sound);
                    audio.play();
                }
            }
        }
    }
</script>

<style scoped>

</style>
