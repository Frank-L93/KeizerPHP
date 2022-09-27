<template>
  <div>
    <teleport to="head">
      <title>{{ title('Nieuwe aanwezigheid') }}</title>
    </teleport>
    <modal close-url="/presences/">
      <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
        <form @submit.prevent="submit">
          <div class="px-8 pt-6 pb-5 border-b font-bold leading-none bg-gray-100">
            Voeg een nieuwe aanwezigheid toe
          </div>

          <div class="p-8 -mr-6 -mb-8 grid grid-cols-1">

            <DatePicker
              class="inline-block h-full"
              v-model="form.date"
              :disabled-dates='{ weekdays: [1, 2, 3, 4, 5, 7] }'
              :min-date="selectableDates('min')"
              :max-date="selectableDates('max')"
            >
              <template v-slot="{ inputValue, togglePopover }">
                <div class="flex items-center">
                  <button
                    class="p-2 bg-blue-100 border border-blue-200 hover:bg-blue-200 text-blue-600 rounded-l focus:bg-blue-500 focus:text-white focus:border-blue-500 focus:outline-none"
                    @click="togglePopover()"
                    type="button"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      class="w-4 h-4 fill-current"
                    >
                      <path d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"></path>
                    </svg>
                  </button>
                  <input
                    :value="inputValue"
                    class="bg-white text-gray-700 w-full py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
                    readonly
                  />
                </div>
              </template>
            </DatePicker>
            <select-input
              v-model="form.reason"
              :error="errors.reason"
              class="inline-block mt-1 mb-1 items-center bg-white text-gray-700 py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
              label="Afwezigheidsreden"
              type=""
            >
              <option value="Other">Afwezig met bericht</option>
            </select-input>

          </div>

          <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
            <div>
              <loading-button
                v-model="form.availability"
                :loading="sending1"
                class="inline-block mt-2 py-2 px-2 bg-red-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-red-500"
                type="submit"
                v-on:click="form.availability = 0"
              >Afwezig</loading-button>
            </div>
            <div>
              <loading-button
                v-model="form.availability"
                :loading="sending2"
                class="inline-block mt-2 py-2 px-2 bg-green-300 rounded-xl border-1 shadow-xl border-gray-200 justify-between items-center hover:bg-green-500"
                type="submit"
                v-on:click="form.availability = 1"
              >Aanwezig</loading-button>
            </div>
          </div>
        </form>
      </div>
    </modal>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import LoadingButton from "@/Shared/LoadingButton";
import TextInput from "@/Shared/TextInput";
import Modal from "@/Shared/Modal";
import SelectInput from "@/Shared/SelectInput";
import FileInput from "@/Shared/FileInput";
import { Calendar, DatePicker } from "v-calendar";
import moment from "moment";

export default {
  layout: Layout,
  components: {
    Modal,
    LoadingButton,
    TextInput,
    SelectInput,
    FileInput,
    Calendar,
    DatePicker,
  },
  props: {
    round_dates: Array,
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending1: false,
      sending2: false,

      form: {
        date: moment().format("YYYY-MM-DD"),
        reason: null,
        availability: null,
      },
    };
  },
  methods: {
    submit() {
      this.form.date = moment(this.form.date).format("YYYY-MM-DD");
      if (this.form.availability == 0) {
        this.$inertia.post(this.route("presences.store"), this.form, {
          inline: "default",
          onStart: () => (this.sending1 = true),
          onFinish: () => (this.sending1 = false),
        });
      } else {
        this.$inertia.post(this.route("presences.store"), this.form, {
          inline: "default",
          onStart: () => (this.sending2 = true),
          onFinish: () => (this.sending2 = false),
        });
      }
    },
    selectableDates(option) {
      if (option === "min") {
        const element = this.round_dates[0]["date"];
        let minDate = element.slice(0, 10);
        return minDate;
      } else {
        let max = this.round_dates[this.round_dates.length - 1]["date"];
        let maxDate = max.slice(0, 10);
        return maxDate;
      }
    },
  },
};
</script>