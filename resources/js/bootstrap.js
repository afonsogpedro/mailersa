// Load plugins
import cash from "cash-dom";
import axios from "axios";
import helper from "./helper";
import Velocity from "velocity-animate";
import * as Popper from "@popperjs/core";
import Tabulator from "tabulator-tables";
import xlsx from "xlsx";
import feather from "feather-icons";
import jquery from "jquery/dist/jquery";
import Swal from 'sweetalert';
import Litepicker from "litepicker";
import dayjs from "dayjs";
import Dropzone from "dropzone";
import tail from "tail.select";

// Set plugins globally
window.cash = cash;
window.axios = axios;
window.helper = helper;
window.Velocity = Velocity;
window.Popper = Popper;
window.Tabulator = Tabulator;
window.xlsx = xlsx;
window.feather = feather;
window.Swal = Swal;
window.Litepicker = Litepicker;
window.dayjs = dayjs;
window.$ = window.jQuery = require('jquery');
window.Dropzone = Dropzone;
window.tail = tail;

// CSRF token
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}
