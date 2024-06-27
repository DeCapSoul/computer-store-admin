/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout/Layout.vue'

const contentsRoutes = {
    path: '/contents',
    component: Layout,
    redirect: 'noRedirect',
    name: 'Contents',
    meta: {
        title: 'Contents',
        bootstrapIcon: 'card-list',
        permissions: ['view menu charts'],
    },
    children: [
        {
            path: 'contents/list',
            component: () => import('@/views/content/List.vue'),
            name: 'content-list',
            meta: {title: 'content-list', bootstrapIcon: 'bar-chart-steps', noCache: true},
        },
        {
            path: 'line',
            component: () => import('@/views/charts/Line.vue'),
            name: 'LineChart',
            meta: {title: 'lineChart', bootstrapIcon: 'pie-chart-fill', noCache: true},
        },
        {
            path: 'mixchart',
            component: () => import('@/views/charts/MixChart.vue'),
            name: 'MixChart',
            meta: {title: 'mixChart', bootstrapIcon: 'file-earmark-bar-graph-fill', noCache: true},
        },
    ],
}

export default contentsRoutes
