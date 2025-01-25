var HELPER = (function () {
    var loadBlock = function (message = "Loading...") {
        $.blockUI({
            message: `<div class="blockui-message" style="z-index: 9999"><span class="spinner-border text-primary"></span> ${message} </div>`,
            css: {
                border: "none",
                backgroundColor: "rgba(47, 53, 59, 0)",
                "z-index": 9999,
            },
        });
    };

    var unblock = function (delay) {
        window.setTimeout(function () {
            $.unblockUI();
        }, delay);
    };

    var html_entity_decode = function (txt) {
        var randomID = Math.floor(Math.random() * 100000 + 1);
        $("body").append('<div id="random' + randomID + '"></div>');
        $("#random" + randomID).html(txt);
        var entity_decoded = $("#random" + randomID).html();
        $("#random" + randomID).remove();
        return entity_decoded;
    };

    return {
        getUriSegment: function (index = "") {
            var url = $(location)
                .attr("href")
                .split("/")
                .splice(0, 5)
                .join("/");
            var segment = url.split("/");
            if (index == "") {
                return segment;
            } else {
                return segment[index];
            }
        },
        displayText: function (data, whiteClass = false) {
            if (whiteClass) {
                $.each(data, function (i, v) {
                    $(`.${i}`)
                        .remove()
                        .queue(function () {
                            $(`.${v}`).removeClass("d-none").dequeue();
                            $(`.${v}`).removeClass(v).dequeue();
                        });
                });
            } else {
                $.each(data, function (i, v) {
                    $(`.${v}`)
                        .remove()
                        .queue(function () {
                            $(`#${v}`).removeClass("d-none").dequeue();
                            $(`.${v}`).removeClass("d-none").dequeue();
                        });
                });
            }
        },
        pushText: function (data) {
            $.each(data, function (i, v) {
                $(`.${i}`)
                    .remove()
                    .queue(function () {
                        $(`#${i}`).html(v).dequeue();
                    });
            });
        },
        getSlug: function () {
            var url = $(location).attr("href");
            url = url.split("/").reverse()[0];
            url = url.split("?")[0];
            return url;
        },
        createSlug: function (str) {
            str = str.toLowerCase();
            str = str.replace(/[^a-z0-9]+/g, "-");
            str = str.replace(/^-+|-+$/g, "");
            return str;
        },
        setStorage: function (key, value = "") {
            localStorage.setItem(key, value);
        },
        getStorage: function (key) {
            localStorage.getItem(key);
        },
        desStorage: function (key) {
            localStorage.removeItem(key);
        },
        block: function (msg) {
            loadBlock(msg);
        },
        unblock: function (delay) {
            unblock(delay);
        },
        toRp: function (angka, num = false) {
            if (angka == "" || angka == "undefined" || angka == null) {
                angka = 0;
            }
            var hasil = 0;
            try {
                hasil = new Intl.NumberFormat("id-ID").format(angka);
            } catch (e) {
                var rev = parseInt(angka, 10)
                    .toString()
                    .split("")
                    .reverse()
                    .join("");
                var rev2 = "";
                var zero = num ? ",00" : "";
                for (var i = 0; i < rev.length; i++) {
                    rev2 += rev[i];
                    if ((i + 1) % 3 === 0 && i !== rev.length - 1) {
                        rev2 += ".";
                    }
                }
                hasil = "" + rev2.split("").reverse().join("") + zero;
            }
            return "Rp" + hasil;
        },
        html_entity_decode: function (txt) {
            html_entity_decode(txt);
        },
        decodeEntity: function (str) {
            return $("<textarea></textarea>").html(str).text();
        },
        nullConverter: function (val, xval) {
            var retval = val;
            if (val === null || val === "" || typeof val == "undefined") {
                retval = typeof xval != "undefined" ? xval : "-";
            }
            return retval;
        },
        showMessage: function (config) {
            config = $.extend(
                true,
                {
                    success: false,
                    message: "System error, please contact the Administrator",
                    title: "Failed",
                    time: 5000,
                    sticky: false,
                    allowOutsideClick: true,
                    toast: false,
                    type: "blue",
                    btnClass: "btn-primary",
                    callback: function () {},
                },
                config
            );
            if (config.toast === false) {
                if (config.success == true) {
                    $.confirm({
                        title:
                            config.title == "Failed" ? "Success" : config.title,
                        content: config.message,
                        theme: "material",
                        type: config.type,
                        buttons: {
                            ok: {
                                text: "ok!",
                                btnClass: config.btnClass,
                                keys: ["enter"],
                                action: function () {
                                    config.callback(true);
                                },
                            },
                        },
                    });
                } else {
                    $.confirm({
                        title: config.title,
                        content: config.message,
                        theme: "material",
                        type: "red",
                        buttons: {
                            ok: {
                                text: "ok!",
                                btnClass: config.btnClass,
                                keys: ["enter"],
                                action: function () {
                                    config.callback(true);
                                },
                            },
                        },
                    });
                }
            } else {
                `toastr`.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: false,
                    progressBar: true,
                    positionClass: "toast-bottom-right",
                    preventDuplicates: false,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                };
                if (config.success == true) {
                    toastr.success(
                        config.message,
                        config.title == "Failed" ? "Success" : config.title
                    );
                } else if (config.success == false) {
                    toastr.error(config.message, config.title);
                } else if (config.success == "warning") {
                    toastr.warning(
                        config.message,
                        config.title == "Failed" ? "Warning" : config.title
                    );
                } else {
                    toastr.info(config.message, config.title);
                }
            }
        },

        months: function (index, short = false, indo = "en") {
            var month1 = {
                en: [
                    "",
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ],
                in: [
                    "",
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember",
                ],
            };
            var month2 = {
                in: [
                    "",
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                in: [
                    "",
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agu",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
            };
            var month = "";
            if (short) {
                month = month2[indo][index];
            } else {
                month = month1[indo][index];
            }
            return month;
        },

        days: function (index, short = false) {
            var day1 = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ];
            var day2 = ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"];
            var day = "";
            if (short) {
                day = day2[index.getDay()];
            } else {
                day = day1[index.getDay()];
            }
            return day;
        },

        reset_format: function (_number) {
            var number = numeral(_number.toString().replace(/,/g, ""));
            return number.value();
        },

        number_format: function (_number) {
            if (_number == null || isNaN(_number)) {
                _number = 0;
            }

            var number = numeral(_number.toString().replace(/,/g, ""));
            var num = number.format("0,0.00");
            return num;
        },

        toInteger: function (_number, _default = 0) {
            return isNaN(parseInt(_number, 10))
                ? _default
                : parseInt(_number, 10);
        },

        toFixed: function (n, fixed) {
            return `${n}`.match(new RegExp(`^-?\\d+(?:\.\\d{0,${fixed}})?`))[0];
        },

        protect_email: function (user_email) {
            var avg, splitted, part1, part1_2, part2, part2_1, part3;
            splitted = user_email.split("@");
            part1 = splitted[0];
            avg = part1.length / 2;
            length = part1.length;
            part1 = part1.substring(0, part1.length - avg);
            part1_2 = "";
            for (var i = 0; i <= length - avg; i++) {
                part1_2 += "*";
            }
            part2 = splitted[1].split(".");
            part3 = part2.pop();
            part2 = part2.join("");
            avg = part2.length / 2;
            length = part2.length;
            part2 = part2.substring(0, part2.length - avg);
            part2_2 = "";
            for (var i = 0; i <= length - avg; i++) {
                part2_2 += "*";
            }
            return part1 + part1_2 + "@" + part2 + part2_2 + "." + part3;
        },

        colorIsDark: function (color) {
            if (color.match(/^rgb/)) {
                color = color.match(
                    /^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/
                );
                r = color[1];
                g = color[2];
                b = color[3];
            } else {
                color = +(
                    "0x" +
                    color.slice(1).replace(color.length < 5 && /./g, "$&$&")
                );
                r = color >> 16;
                g = (color >> 8) & 255;
                b = color & 255;
            }
            hsp = Math.sqrt(
                0.299 * (r * r) + 0.587 * (g * g) + 0.114 * (b * b)
            );
            if (hsp > 127.5) {
                return false;
            } else {
                return true;
            }
        },

        text_truncate: function (str, length = null, ending = null) {
            str = HELPER.nullConverter(str);
            if (length == null) length = 100;
            if (ending == null) ending = "...";
            if (str.length > length) {
                return str.substring(0, length - ending.length) + ending;
            } else {
                return str;
            }
        },

        textMore: function (config) {
            config = $.extend(
                true,
                {
                    text: "-",
                    length: 50,
                    ending: "...",
                    btn_text: "Lihat banyak",
                    btn_text_reverse: "Lihat sedikit",
                    reverse: false,
                    fromReverse: false,
                    from: 1,
                    callbackClick: function () {},
                },
                config
            );
            var str = HELPER.nullConverter(config.text);
            var btn_click = "";
            var btn_click_reverse = "";
            if (str.length > config.length) {
                try {
                    if (config.reverse) {
                        if (config.fromReverse) {
                            config.fromReverse = false;
                            btn_click = `<a href="javascript:void(0)" data-config="${btoa(
                                JSON.stringify(config)
                            )}" onclick="HELPER.clickTextMore(this)" title="${
                                config.btn_text_reverse
                            }">${config.btn_text_reverse}</a>`;
                            str = config.text + " " + btn_click;
                        } else {
                            config.fromReverse = true;
                            var temp_str = HELPER.text_truncate(
                                config.text,
                                config.length,
                                config.ending
                            );
                            btn_click = `<a href="javascript:void(0)" data-config="${btoa(
                                JSON.stringify(config)
                            )}" onclick="HELPER.clickTextMore(this)" title="${
                                config.btn_text
                            }">${config.btn_text}</a>`;
                            str = temp_str + " " + btn_click;
                        }
                    } else {
                        if (config.from) {
                            var temp_str = HELPER.text_truncate(
                                config.text,
                                config.length,
                                config.ending
                            );
                            btn_click = `<a href="javascript:void(0)" data-config="${btoa(
                                JSON.stringify(config)
                            )}" onclick="HELPER.clickTextMore(this)" title="${
                                config.btn_text
                            }">${config.btn_text}</a>`;
                            str = temp_str + " " + btn_click;
                        } else {
                            str = config.text;
                        }
                    }
                } catch (e) {
                    console.log(e);
                }
            }
            var temp_span = `<span style="white-space:normal;" title="${config.text}">${str}</span>`;
            return temp_span;
        },

        clickTextMore: function (el) {
            if ($(el).data().hasOwnProperty("config")) {
                var config = JSON.parse(atob($(el).data("config")));
                config.from = 0;
                $(el).parent().html(HELPER.textMore(config));
            }
        },

        populateForm: function (frm, data) {
            $.each(data, function (key, value) {
                var $ctrl = $('[name="' + key + '"]', frm);
                if ($ctrl.is("select")) {
                    if ($ctrl.data().hasOwnProperty("select2")) {
                        $ctrl.val(value).trigger("change");
                    } else {
                        $("option", $ctrl).each(function () {
                            if (this.value == value) {
                                this.selected = true;
                                $ctrl.trigger("change")
                            }
                        });
                    }
                } else if ($ctrl.is("textarea")) {
                    if (typeof $ctrl.data("_inputmask_opts") != "undefined") {
                        var inputmask_opt = $ctrl.data("_inputmask_opts");
                        if (inputmask_opt.hasOwnProperty("digits")) {
                            $ctrl.val(parseFloat(value));
                        } else {
                            $ctrl.val(value);
                        }
                    } else if (
                        typeof $ctrl.data("mousewheelLineHeight") != "undefined"
                    ) {
                        if (value != "" && value.length > 5) {
                            $ctrl.clockTimePicker(
                                "value",
                                value.substring(0, 5)
                            );
                        } else {
                            $ctrl.val(value);
                        }
                    } else {
                        $ctrl.val(value);
                    }
                } else {
                    switch ($ctrl.attr("type")) {
                        case "text":
                        case "date":
                        case "email":
                        case "number":
                        case "hidden":
                        case "color":
                            if (
                                typeof $ctrl.data("_inputmask_opts") !=
                                "undefined"
                            ) {
                                var inputmask_opt =
                                    $ctrl.data("_inputmask_opts");
                                if (inputmask_opt.hasOwnProperty("digits")) {
                                    $ctrl.val(parseFloat(value));
                                } else {
                                    $ctrl.val(value);
                                }
                            } else if (
                                typeof $ctrl.data("mousewheelLineHeight") !=
                                "undefined"
                            ) {
                                if (value != "" && value.length > 5) {
                                    $ctrl.clockTimePicker(
                                        "value",
                                        value.substring(0, 5)
                                    );
                                } else {
                                    $ctrl.val(value);
                                }
                            } else {
                                $ctrl.val(value);
                            }
                            break;
                        case "radio":
                        case "checkbox":
                            $ctrl.each(function () {
                                if ($(this).attr("value") == value) {
                                    $(this).prop("checked", true);
                                } else {
                                    $(this).prop("checked", false);
                                }
                            });
                            break;
                    }
                }
            });
        },

        convertK: function (num, digits = 1, lang = "id") {
            var si = [
                {
                    value: 1,
                    symbol: "",
                },
                {
                    value: 1e3,
                    symbol: lang == "id" ? "rb" : "k",
                },
                {
                    value: 1e6,
                    symbol: lang == "id" ? "jt" : "M",
                },
                {
                    value: 1e9,
                    symbol: lang == "id" ? "M" : "G",
                },
                {
                    value: 1e12,
                    symbol: lang == "id" ? "T" : "T",
                },
                {
                    value: 1e15,
                    symbol: lang == "id" ? "P" : "P",
                },
                {
                    value: 1e18,
                    symbol: lang == "id" ? "E" : "E",
                },
            ];
            var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
            var i;
            for (i = si.length - 1; i > 0; i--) {
                if (num >= si[i].value) {
                    break;
                }
            }
            return (
                (num / si[i].value).toFixed(digits).replace(rx, "$1") +
                si[i].symbol
            );
        },

        convertSimpleK: function (labelValue) {
            // Nine Zeroes for Billions
            return Math.abs(Number(labelValue)) >= 1.0e9
                ? Math.abs(Number(labelValue)) / 1.0e9 + "M"
                : // Six Zeroes for Millions
                Math.abs(Number(labelValue)) >= 1.0e6
                ? Math.abs(Number(labelValue)) / 1.0e6 + "Jt"
                : // Three Zeroes for Thousands
                Math.abs(Number(labelValue)) >= 1.0e3
                ? Math.abs(Number(labelValue)) / 1.0e3 + "Rb"
                : Math.abs(Number(labelValue));
        },

        isNull: function (val) {
            var retval = val;
            if (
                val === null ||
                val === "" ||
                typeof val == "undefined" ||
                val == "null" ||
                val.length == 0
            ) {
                return true;
            }
            return false;
        },

        ucwords: function (str = "") {
            str = HELPER.nullConverter(str);
            str = str.toLowerCase();
            return str.replace(/(\b)([a-zA-Z])/g, function (firstLetter) {
                return firstLetter.toUpperCase();
            });
        },

        autoPreviewYt: function (config) {
            config = $.extend(
                true,
                {
                    el: null,
                    width: 560,
                    height: 315,
                    callback: function () {},
                },
                config
            );
            $(config.el)
                .off("change")
                .on("change", function () {
                    $(this)
                        .parent()
                        .find(".container-err-yt, .container-preview-yt")
                        .remove();
                    if (!HELPER.isNull(this.value)) {
                        if (HELPER.isUrl(this.value)) {
                            var idYt = HELPER.getIdYt(this.value);
                            if (!HELPER.isNull(idYt)) {
                                config.callback(idYt);
                                $(this).after(`
                              <div class="row w-100 mt-3 container-preview-yt text-center">
                                  <div class="col-12">
                                      <iframe width="${config.width}" height="${config.height}" src="https://www.youtube.com/embed/${idYt}" 
                                          title="YouTube video player" 
                                          frameborder="0" 
                                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                          allowfullscreen>
                                      </iframe>
                                  </div>
                              </div>
                          `);
                            } else {
                                $(this).after(
                                    '<span class="text-danger font-italic container-err-yt">URL tidak dapat digunakan !</span>'
                                );
                            }
                        } else {
                            $(this).after(
                                '<span class="text-danger font-italic container-err-yt">Harap input URL dengan benar !</span>'
                            );
                        }
                    }
                });
        },

        isUrl: function (link) {
            var url;
            try {
                url = new URL(link);
            } catch (e) {
                return false;
            }
            return true;
        },

        getIdYt: function (link) {
            var url = new URL(link);
            if (url.searchParams.has("v") && url.searchParams.get("v")) {
                return url.searchParams.get("v");
            } else if (
                url.hostname == "youtu.be" &&
                url.pathname &&
                url.pathname.length > 1
            ) {
                return url.pathname.substring(1);
            } else if (url.pathname.indexOf("embed") >= 0) {
                var idd = null;
                $.each(url.pathname.split("/"), function (i, v) {
                    if (!HELPER.isNull(v) && v != "embed") {
                        idd = v;
                    }
                });
                return idd;
            } else {
                return null;
            }
        },

        resetForm: function (form = "") {
            $(form)
                .find(
                    `textarea,input:not('[type="checkbox"], [type="radio"]'),select`
                )
                .val("")
                .change();
        },

        disableInput: function (form = "") {
            $(`${form} input,select,textarea`).attr("disabled", "disabled");
        },

        enableInput: function (form = "") {
            $(`${form} input,select,textarea`).removeAttr("disabled");
        },

        generateQR: function (config) {
            config = $.extend(
                true,
                {
                    el: null,
                    width: 300,
                    height: 300,
                    data: "http://localhost:8080/test",
                    margin: 0,
                    qrOptions: {
                        typeNumber: "0",
                        mode: "Byte",
                        errorCorrectionLevel: "Q",
                    },
                    imageOptions: {
                        hideBackgroundDots: true,
                        imageSize: 0.4,
                        margin: 5,
                    },
                    dotsOptions: {
                        type: "extra-rounded",
                        color: "#37b629",
                        gradient: null,
                    },
                    backgroundOptions: { color: "#ffffff" },
                    image: "/assets/media/qr-logo.png",
                    dotsOptionsHelper: {
                        colorType: { single: true, gradient: false },
                        gradient: {
                            linear: true,
                            radial: false,
                            color1: "#6a1a4c",
                            color2: "#6a1a4c",
                            rotation: "0",
                        },
                    },
                    cornersSquareOptions: {
                        type: "extra-rounded",
                        color: "#016d00",
                    },
                    cornersSquareOptionsHelper: {
                        colorType: { single: true, gradient: false },
                        gradient: {
                            linear: true,
                            radial: false,
                            color1: "#000000",
                            color2: "#000000",
                            rotation: "0",
                        },
                    },
                    cornersDotOptions: { type: "", color: "#016d00" },
                    cornersDotOptionsHelper: {
                        colorType: { single: true, gradient: false },
                        gradient: {
                            linear: true,
                            radial: false,
                            color1: "#000000",
                            color2: "#000000",
                            rotation: "0",
                        },
                    },
                    backgroundOptionsHelper: {
                        colorType: { single: true, gradient: false },
                        gradient: {
                            linear: true,
                            radial: false,
                            color1: "#ffffff",
                            color2: "#ffffff",
                            rotation: "0",
                        },
                    },
                },
                config
            );

            $("#" + config.el).html("");
            var qrCode = new QRCodeStyling(config);
            qrCode.append(document.getElementById(config.el));
            return qrCode;
        },

        downloadQR: function (config) {
            config = $.extend(
                true,
                {
                    name: "qr",
                    el: null,
                },
                config
            );
            var canvas = config.el;
            var dataURL = canvas.toDataURL("image/png");
            var link = $("<a>");
            link.attr("download", config.name + ".png");
            link.attr("href", dataURL);
            link[0].click();
        },

        genKey: function (length = 16) {
            const characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            let result = "";

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(
                    Math.random() * characters.length
                );
                result += characters.charAt(randomIndex);
            }

            return result;
        },

        setChangeCombo: function (config) {
            config = $.extend(true, {
                el: null,
                data: {},
                valueField: null,
                valueAdd: null,
                displayField: null,
                displayField2: null,
                grouped: false,
                withNull: true,
                withNullDisabled: true,
                idMode: false,
                tags: false,
                placeholder: '',
                select2: false,
                allowClear: true,
                selectedValue: null,
                searchBox: true,
                dropdownParent: ''
            }, config);

            if (config.idMode === true) {
                var html = (config.withNull === true) ? "<option value='' selected " + ((config.withNullDisabled) ? 'disabled' : '') + ">" + config.placeholder + "</option>" : "";
                $.each(config.data, function (i, v) {
                    var vAdd = '';
                    if (v[config.valueAdd]) {
                        vAdd = " data-add='" + v[config.valueAdd] + "'";
                    }
                    if (config.grouped) {
                        selectedOpt = config.selectedValue == v[config.valueField] ? ' selected' : ''
                        if (config.displayField3 != null) {
                            html += "<option value='" + v[config.valueField] + "' " + vAdd + selectedOpt + ">" + v[config.displayField2] + " - " + v[config.displayField] + " ( " + v[config.displayField3] + " ) " + "</option>";
                        } else {
                            html += "<option value='" + v[config.valueField] + "' " + vAdd + selectedOpt + ">" + v[config.displayField2] + " - " + v[config.displayField] + "</option>";
                        }
                    } else {
                        selectedOpt = config.selectedValue == v[config.valueField] ? ' selected' : ''
                        html += "<option value='" + v[config.valueField] + "' " + vAdd + selectedOpt + ">" + v[config.displayField] + "</option>";
                    }
                });
                $('#' + config.el).html(html);
            } else {
                var html = (config.withNull === true) ? "<option value='' selected " + ((config.withNullDisabled) ? 'disabled' : '') + ">" + config.placeholder + "</option>" : "";
                $.each(config.data, function (i, v) {
                    var vAdd = '';
                    if (v[config.valueAdd]) {
                        vAdd = " data-add='" + v[config.valueAdd] + "'";
                    }
                    if (config.grouped) {
                        selectedOpt = config.selectedValue == v[config.valueField] ? ' selected' : ''
                        if (config.displayField3 != null) {
                            html += "<option value='" + v[config.valueField] + "' " + vAdd + selectedOpt + ">" + v[config.displayField2] + " - " + v[config.displayField] + " ( " + v[config.displayField3] + " ) " + "</option>";
                        } else {
                            html += "<option value='" + v[config.valueField] + "' " + vAdd + selectedOpt + ">" + v[config.displayField2] + " - " + v[config.displayField] + "</option>";
                        }
                    } else {
                        selectedOpt = config.selectedValue == v[config.valueField] ? ' selected' : ''
                        html += "<option value='" + v[config.valueField] + "' " + vAdd + selectedOpt + ">" + v[config.displayField] + "</option>";
                    }
                });
                $('#' + config.el).html(html);
            }

            if (config.select2) {
                $('#' + config.el).select2({
                    allowClear: config.allowClear,
                    dropdownAutoWidth: true,
                    placeholder: config.placeholder,
                    tags: config.tags,
                    width: '100%',
                    minimumResultsForSearch: config.searchBox ? 0 : Infinity,
                    dropdownParent: config.dropdownParent
                });
                config.selectedValue ? $('#' + config.el).trigger('change') : null
            }
        },

        ajax: function (config) {
            config = $.extend(
                true,
                {
                    data: {},
                    url: null,
                    type: "POST",
                    dataType: null,
                    success: function () {},
                    complete: function () {},
                    error: function () {},
                },
                config
            );
            if (config.data instanceof FormData) {
                for (var key of config.data.keys()) {
                    if (
                        config.data.get(key) instanceof File == false &&
                        !HELPER.isNull(config.data.get(key))
                    ) {
                        try {
                            var san = HtmlSanitizer.SanitizeHtml(
                                config.data.get(key)
                            );
                            config.data.set(key, san);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
            } else {
                for (var key in config.data) {
                    if (!HELPER.isNull(config.data.key)) {
                        try {
                            var san = HtmlSanitizer.SanitizeHtml(
                                config.data.key
                            );
                            config.data.key = san;
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
            }
            var xdefault = {
                url: config.url,
                data: config.data,
                type: config.type,
                dataType: config.dataType,
                success: function (data) {
                    config.success(data);
                },
                complete: function (response) {
                    var rsp = $.parseJSON(response.responseText);
                    config.complete(rsp, response);
                },
                error: function (error) {
                    var err = error.responseJSON;
                    if (
                        (Array.isArray(err) || typeof err === "object") &&
                        err.success == false &&
                        err.hasOwnProperty("code")
                    ) {
                        HELPER.showMessage({
                            success: false,
                            message: err.message,
                            allowOutsideClick: false,
                            callback: function () {
                                if (err.code == "401") {
                                    window.location.reload();
                                }
                            },
                        });
                    }
                    config.error(error);
                },
            };
            if (config.hasOwnProperty("contentType")) {
                xdefault["contentType"] = config.contentType;
            }
            if (config.hasOwnProperty("processData")) {
                xdefault["processData"] = config.processData;
            }
            $.ajax(xdefault);
        },

    };
})();

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || "");
        } else {
            o[this.name] = this.value || "";
        }
    });
    return o;
};
