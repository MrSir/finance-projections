<template>
    <ul class="sidebar-menu">
        <li v-bind:class="{ active: active_route == 'home' }">
            <a href="/"><i class="fa fa-home"></i> <span>Home</span></a>
        </li>
        <li v-bind:class="{ active: active_route == 'transactions' }">
            <a href="/transactions"><i class="fa fa-dollar"></i> <span>Transactions</span></a>
        </li>
        <li v-bind:class="{ active: active_route == 'accounts' }">
            <a href="/accounts"><i class="fa fa-bank"></i> <span>Accounts</span></a>
        </li>
        <li v-bind:class="{ active: active_route == 'categories' }">
            <a href="/categories"><i class="fa fa-filter"></i> <span>Categories</span></a>
        </li>
        <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
            </ul>
        </li>
    </ul>
</template>

<script>
    export default {
        mounted() {

        },
        props: ['active_route']
    }
</script>
