<template>
  <div class="all-blog-container">
    <div class="d-flex justify-content-center mt-4" v-if="pageCounts > 1">
      <paginate
        :prevText="''"
        :nextText="''"
        v-model="page"
        :pageCount="pageCounts"
        :clickHandler="getItems"
      >
      </paginate>
    </div>
    <!-- End blog pagination -->
    <!-- End Blog Section -->
  </div>
</template>

<script>
import { onMounted, reactive, ref, toRefs } from "vue";
import useVuelidate from "@vuelidate/core";
import { useI18n } from "vue-i18n";
import blogClient from "../../http-clients/web/blog-client";
import { useRoute } from "vue-router";
import Paginate from "vuejs-paginate-next";

export default {
  components: {
    Paginate,
  },
  setup() {
    // Form setup
    const route = useRoute();
    const { t, locale } = useI18n({ useScope: "global" });
    const data = reactive({
      pageSize: 6,
      page: 1,
      items: [],
      pageCounts: 0,
      totalItems: 0,
    });
    onMounted(() => {
      data.page = 1;
      getItems();
    });
    const rules = {};
    const v$ = useVuelidate(rules);
    //Methods
    function getItems() {
      blogClient
        .getItems(data.page, data.pageSize)
        .then((response) => {
          data.items = response.data.data;
          data.pageCounts = Math.ceil(response.data.total / data.pageSize);
          data.totalItems = response.data.total;
        })
        .catch((error) => {});
    }
    return {
      getItems,
      ...toRefs(data),
      v$,
    };
  },
};
</script>

<style lang="scss">
.all-blog-container {
  .page-link:hover {
    cursor: pointer;
  }
  .page-link {
    align-items: center;
    justify-content: center;
    display: flex;
    border-radius: 0px;
    width: 40px;
    height: 34px;
    border: none;
  }
  .page-item.active .page-link {
    background-color: var(--color-primary);
  }
  .page-item {
    padding: 0 5px;
  }
}
</style>

