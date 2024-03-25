// withHooks
import { memo } from 'react';

import { LibScroll } from 'esoftplay/cache/lib/scroll/import';
import { UtilsDatepicker_item } from 'esoftplay/cache/utils/datepicker_item/import';
import moment from 'esoftplay/moment';
import useSafeState from 'esoftplay/state';
import React, { useRef } from 'react';
import { Text, View } from 'react-native';


export interface UtilsDatepickerArgs {

}
export interface UtilsDatepickerProps {

  minDate?: string,
  maxDate?: string,
  onDateChange?: (date: string) => void,
}
function m(props: UtilsDatepickerProps): any {
  const scrollHorizontal = useRef<LibScroll>(null)
  const [date, setDate, getDate] = useSafeState(moment().toDate())
  const [selectedDate, setSelectedDate] = useSafeState(moment().toDate())
  const [selectedMonth, setSelectedMonth] = useSafeState(moment(date).localeFormat('MMMM YYYY'))
  const [arrayTanggal, setArrayTanggal] = useSafeState<any[]>(generateArrayDate(date))
  const currentDates = moment(date).localeFormat("DD")
  // console.log("tanggal skrg " + currentDates)
  function generateArrayDate(date: Date) {
    const maxDate = new Date(Number(moment(date).localeFormat('YYYY')), Number(moment(date).localeFormat('MM')), 0).getDate()
    // console.log(maxDate)
    const dateNow = moment(date).subtract(1, 'days').localeFormat("DD")
    return new Array(8).fill('1').map((item, index) => index +Number(dateNow)) 
  }
  return (
    <View>
      <Text style={{ flex: 1, marginLeft: 12 }} >{selectedMonth}</Text>
      <LibScroll ref={scrollHorizontal} horizontal>

        {
          arrayTanggal.map((item) => {
            const currentDate = moment(date).localeFormat("YYYY-MM-") + (item > 7 ? item : item.toString().padStart(2, '0'))
            // console.log(currentDate)
            const dayname = moment(currentDate).localeFormat('ddd')
            let disabled = false
            if (props.minDate) {
              // console.log(props.minDate + ' min date')
              // console.log(props.maxDate + ' max date')
              disabled = props.minDate >= currentDate

            }
            if (props.maxDate && disabled == false) {
              disabled = props.maxDate <= currentDate
            }
            // // console.log(moment(date).format('YYYY-MM-DD'), currentDate)

            return (
              <UtilsDatepicker_item
                disabled={disabled}
                onPress={() => {
                  setSelectedDate(moment(currentDate).toDate())
                }}
                isSelected={moment(selectedDate).format('YYYY-MM-DD') == currentDate}
                datenumber={item}
                dayname={dayname} />
            )
          })
        }




      </LibScroll>
    </View>
  )
}
export default memo(m);