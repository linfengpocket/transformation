<template>
  <div>
    <a-card title="報告列表" size="small">
      <template #extra>
        <a-input-search enter-button></a-input-search>
      </template>
      <a-table style="width:auto;margin:0 auto;" size="small" :data-source="chargingReports.data" :columns="columns"
               rowKey="id"
               bordered
               :pagination="false">

        <template slot="park" slot-scope="text,record">
          {{ record.park.name }}
        </template>
        <template slot="user" slot-scope="text,record">
          {{ record.user.name }}
        </template>
        <template slot="chargingPiles" slot-scope="text,record">
        <span v-for="(item,index) in record.chargingPiles" :key="index">
        <a-tag>{{ item.device_id }}</a-tag>
        </span>
        </template>
        <template slot="action" slot-scope="text,record">
          <a-button-group>
            <a-button type="primary" size="small" @click="showReport(record)">查看</a-button>
            <a-button type="primary" size="small" @click="test(record)">測試</a-button>
            <a-button type="danger" size="small" icon="cloud-download" @click="makeReport(record)" ghost>PDF</a-button>
          </a-button-group>
        </template>
      </a-table>
      <a-pagination v-if="chargingReports.total>chargingReports.per_page" :defaultCurrent='1'
                    :total="chargingReports.total"
                    :pageSize="chargingReports.per_page"
                    @change="getChargingReports">
      </a-pagination>
    </a-card>

  </div>
</template>

<script>
const columns = [
  {
    title: 'ID',
    dataIndex: 'id',
    key: 'id',
    width: 60,
    align: 'center'
  },
  {
    title: '日期',
    dataIndex: 'report_date',
    key: 'report_date',
    width: 80,
    align: 'center'
  },
  {
    title: '停車場',
    dataIndex: 'park_name',
    key: 'park_name',
    scopedSlots: {customRender: 'park'},
  },
  {
    title: '填報人',
    dataIndex: 'user_id',
    key: 'user_id',
    align: 'center',
    scopedSlots: {customRender: 'user'},

  },
  {
    title: '操作',
    key: 'action',
    dataIndex: 'action',
    align: 'center',
    scopedSlots: {customRender: 'action'}
  },
]
export default {
  data() {
    return {
      chargingReports: [],
      columns,
    }
  },
  created() {
    this.getChargingReports()
  },
  methods: {
    async getChargingReports(page = 1) {
      this.chargingReports = await this.axios.get(`admin/chargingreport?page=${page}`)
    },
    showReport(record) {
      this.$router.push({path: `/admin/charge/${record.id}/show`})
    },
    async makeReport(record) {
      window.open(`/chargingreport/${record.id}/exportpdf`)
    },
    async test(record) {
      this.axios.post(`admin/chargingreport/${record.id}/test`)
    }
  }
}
</script>

<style scoped>

</style>