(()=>{var s=`<div>
    <mt-card
        :is-loading="isLoading"
        :title="$tc('frosh-flow-builder-insights.history.cardTitle')"
        position-identifier="sw-flow-frosh-history-list"
    >
        <template #grid>
            <sw-one-to-many-grid
                v-if="flow"
                :collection="flow.extensions.froshFlowStates"
                :columns="columns"
                :full-page="false"
                :local-mode="false"
                :allow-inline-edit="false"
                :allow-delete="false"
                :selectable="false"
            >
                <template #column-createdAt="{ item }">
                    {{ dateFilter(item.createdAt, { hour: '2-digit', minute: '2-digit' }) }}
                </template>

                <template #column-state="{ item }">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <sw-color-badge
                            :color="getStateColor(item.state)"
                            rounded
                        />
                        {{ $tc('frosh-flow-builder-insights.history.state.' + item.state) }}
                    </div>
                </template>

                <template #column-triggeredBy="{ item }">
                    <router-link
                        v-if="item.customer"
                        :to="{ name: 'sw.customer.detail', params: { id: item.customerId } }"
                        style="display: inline-flex; align-items: center; gap: 6px;"
                    >
                        <sw-icon
                            name="regular-users"
                            size="16"
                        />
                        {{ item.customer.firstName }}
                        {{ item.customer.lastName }}
                        (
                        {{ item.customer.customerNumber }}
                        )
                    </router-link>
                    <router-link
                        v-else-if="item.user"
                        :to="{ name: 'sw.users.permissions.user.detail', params: { id: item.userId } }"
                        style="display: inline-flex; align-items: center; gap: 6px;"
                    >
                        <sw-icon
                            name="regular-user"
                            size="16"
                        />
                        {{ item.user.username }}
                    </router-link>
                    <router-link
                        v-else-if="item.integration"
                        :to="{ name: 'sw.integration.index' }"
                        style="display: inline-flex; align-items: center; gap: 6px;"
                    >
                        <sw-icon
                            name="regular-plug"
                            size="16"
                        />
                        {{ item.integration.label }}
                    </router-link>
                </template>

                <template #actions="{ item }">
                    <sw-context-menu-item @click="openDetailsModal(item)">
                        {{ $tc('frosh-flow-builder-insights.history.actions.showDetails') }}
                    </sw-context-menu-item>
                </template>
            </sw-one-to-many-grid>
        </template>
    </mt-card>
    <frosh-flow-data-modal
        v-if="modalEntry"
        :flowHistoryEntry="modalEntry"
        @modal-close="onCloseModal"
    />
</div>
`;var{Component:r,Store:n}=Shopware,{mapState:m}=r.getComponentHelper();r.register("frosh-flow-history",{template:s,props:{isLoading:{type:Boolean,required:!1,default:!1}},data:()=>({modalEntry:null}),computed:{columns(){return[{property:"createdAt",label:this.$tc("frosh-flow-builder-insights.history.columns.executedAt"),primary:!0},{property:"state",label:this.$tc("frosh-flow-builder-insights.history.columns.status")},{property:"triggeredBy",label:this.$tc("frosh-flow-builder-insights.history.columns.triggeredBy")}]},dateFilter(){return Shopware.Filter.getByName("date")},...m(()=>n.get("swFlow"),["flow"])},methods:{getStateColor(t){return{success:"#37d046",error:"#de294c"}[t]||"#d1d9e0"},openDetailsModal(t){this.modalEntry=t},onCloseModal(){this.modalEntry=null}}});var i=`<sw-modal
    :title="$tc('frosh-flow-builder-insights.dataModal.title')"
    @modal-close="onModalChange"
>
    <template #body>
        <sw-container style="padding: 20px 30px;">
            <sw-container
                columns="1fr 1fr 1fr"
                gap="0px 15px"
                class="frosh-flow-data-modal__metadata"
            >
                <sw-description-list>
                    <dt>
                        {{ $tc('frosh-flow-builder-insights.history.columns.executedAt') }}
                    </dt>
                    <dd>{{ executedAt }}</dd>
                </sw-description-list>
                <sw-description-list>
                    <dt>
                        {{ $tc('frosh-flow-builder-insights.history.columns.status') }}
                    </dt>
                    <dd>
                        <div
                            style="display: flex; align-items: center; gap: 8px;"
                        >
                            <sw-color-badge
                                :color="stateColor"
                                rounded
                            />
                            {{ $tc('frosh-flow-builder-insights.history.state.' + flowHistoryEntry.state) }}
                        </div>
                    </dd>
                </sw-description-list>
                <sw-description-list>
                    <dt>
                        {{ $tc('frosh-flow-builder-insights.history.columns.triggeredBy') }}
                    </dt>
                    <dd>
                        <router-link
                            v-if="flowHistoryEntry.customer"
                            :to="{ name: 'sw.customer.detail', params: { id: flowHistoryEntry.customerId } }"
                            style="display: inline-flex; align-items: center; gap: 6px;"
                        >
                            <sw-icon
                                name="regular-users"
                                size="16"
                            />
                            {{ flowHistoryEntry.customer.firstName }}
                            {{ flowHistoryEntry.customer.lastName }}
                            (
                            {{ flowHistoryEntry.customer.customerNumber }}
                            )
                        </router-link>
                        <router-link
                            v-else-if="flowHistoryEntry.user"
                            :to="{ name: 'sw.users.permissions.user.detail', params: { id: flowHistoryEntry.userId } }"
                            style="display: inline-flex; align-items: center; gap: 6px;"
                        >
                            <sw-icon
                                name="regular-user"
                                size="16"
                            />
                            {{ flowHistoryEntry.user.username }}
                        </router-link>
                        <router-link
                            v-else-if="flowHistoryEntry.integration"
                            :to="{ name: 'sw.integration.index' }"
                            style="display: inline-flex; align-items: center; gap: 6px;"
                        >
                            <sw-icon
                                name="regular-plug"
                                size="16"
                            />
                            {{ flowHistoryEntry.integration.label }}
                        </router-link>
                        <template v-else>-</template>
                    </dd>
                </sw-description-list>
            </sw-container>
            <mt-textarea
                :model-value="flowData"
                :label="$tc('frosh-flow-builder-insights.dataModal.payloadLabel')"
                :disabled="true"
            />
        </sw-container>
        <sw-container
            v-if="flowHistoryEntry.error"
            style="border-top: 1px solid #d1d9e0; padding: 20px 30px;"
        >
            <sw-container
                columns="1fr 1fr"
                gap="0px 15px"
                class="frosh-flow-data-modal__metadata"
            >
                <sw-description-list>
                    <dt>
                        {{ $tc('frosh-flow-builder-insights.dataModal.errorType') }}
                    </dt>
                    <dd>
                        {{ flowHistoryEntry.error.type }}
                    </dd>
                </sw-description-list>
                <sw-description-list>
                    <dt>
                        {{ $tc('frosh-flow-builder-insights.dataModal.errorLine') }}
                    </dt>
                    <dd>
                        {{ flowHistoryEntry.error.line }}
                    </dd>
                </sw-description-list>
            </sw-container>
            <sw-description-list class="frosh-flow-data-modal__error-file">
                <dt>
                    {{ $tc('frosh-flow-builder-insights.dataModal.errorFile') }}
                </dt>
                <dd>
                    {{ flowHistoryEntry.error.file }}
                </dd>
            </sw-description-list>
            <mt-textarea
                :model-value="flowHistoryEntry.error.message"
                :label="$tc('frosh-flow-builder-insights.dataModal.errorMessage')"
                :disabled="true"
            />
        </sw-container>
    </template>
</sw-modal>
`;var{Component:c}=Shopware;c.register("frosh-flow-data-modal",{template:i,emits:["modal-close"],props:{flowHistoryEntry:{required:!0,type:Object}},methods:{onModalChange(){this.$emit("modal-close")}},computed:{flowData(){let t=this.flowHistoryEntry.data;return t?JSON.stringify(t,null,2):""},dateFilter(){return Shopware.Filter.getByName("date")},executedAt(){return this.dateFilter(this.flowHistoryEntry.createdAt,{hour:"2-digit",minute:"2-digit"})},stateColor(){return{success:"#37d046",error:"#de294c"}[this.flowHistoryEntry.state]||"#d1d9e0"}}});var l=`{% block sw_flow_tabs_header_extension %}
{% parent() %}

<sw-tabs-item
    v-if="!isNewFlow"
    class="sw-flow-detail__tab-frosh-history"
    :route="{ name: 'sw.flow.detail.frosh_history', params: { id: $route.params.id } }"
    :title="$tc('frosh-flow-builder-insights.history.tabTitle')"
>
    {{ $tc('frosh-flow-builder-insights.history.tabTitle') }}
</sw-tabs-item>
{% endblock %}
`;var{Component:w}=Shopware,{Criteria:u}=Shopware.Data;w.override("sw-flow-detail",{template:l,computed:{flowCriteria(){let t=this.$super("flowCriteria");return t.addAssociation("froshFlowStates"),t.addAssociation("froshFlowStates.user"),t.addAssociation("froshFlowStates.integration"),t.addAssociation("froshFlowStates.customer"),t.getAssociation("froshFlowStates").setLimit(25),t.getAssociation("froshFlowStates").addSorting(u.sort("createdAt","DESC")),t}}});Shopware.Module.register("frosh-flow-tab-history",{routeMiddleware(t,e){let o="sw.flow.detail.frosh_history";e.name==="sw.flow.detail"&&e.children.every(a=>a.name!==o)&&e.children.push({name:o,path:"/sw/flow/detail/:id/frosh-history",component:"frosh-flow-history",meta:{parentPath:"sw.flow.index"}})}});})();
