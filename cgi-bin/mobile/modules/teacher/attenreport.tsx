// withHooks
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import React, { useEffect, useRef, useState } from 'react';
import { FlatList, Platform, Pressable, ScrollView, Text, View } from 'react-native';
import Svg, { Circle } from 'react-native-svg';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import SchoolColors from '../utils/schoolcolor';
import moment from 'esoftplay/moment';


export interface TeacherAttenreportArgs {

}
export interface TeacherAttenreportProps {

}
export default function m(): any {

  // Gunakan fungsi getWeekNumber untuk mendapatkan minggu keberapa dalam tahun ini
  const today = new Date();

  const getWeekNumberInMonth = () => {
    const today = new Date();
    const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

    const pastDays = today.getDate(); // Hari dalam bulan ini
    const firstDayOfWeek = firstDayOfMonth.getDay(); // Hari pertama dalam minggu pertama bulan ini
    const daysBeforeFirstSunday = (7 - firstDayOfWeek) % 7; // Hari sebelum Minggu pertama dimulai
    const daysFromFirstSunday = pastDays - daysBeforeFirstSunday; // Hari setelah Minggu pertama dimulai
    const weekNumberInMonth = Math.ceil(daysFromFirstSunday / 7 + 1); // Minggu keberapa dalam bulan ini

    return weekNumberInMonth;
  };

  // Gunakan fungsi getWeekNumberInMonth untuk mendapatkan minggu keberapa dalam bulan ini
  const weekNumberInMonth = getWeekNumberInMonth();

  const [weekOne, setWeekOne] = useSafeState(0)
  const [weekTwo, setWeekTwo] = useSafeState(0)
  const [weekThree, setWeekThree] = useSafeState(0)
  const [weekFour, setWeekFour] = useSafeState(0)




  const Bulan = [
    {
      "name": "Januari",
      "abbreviation": "Jan",
      "number": 1,
      "days": 31
    },
    {
      "name": "Februari",
      "abbreviation": "Feb",
      "number": 2,
      "days": 28
    },
    {
      "name": "Maret",
      "abbreviation": "Mar",
      "number": 3,
      "days": 31
    },
    {
      "name": "April",
      "abbreviation": "Apr",
      "number": 4,
      "days": 30
    },
    {
      "name": "Mei",
      "abbreviation": "May",
      "number": 5,
      "days": 31
    },
    {
      "name": "Juni",
      "abbreviation": "Jun",
      "number": 6,
      "days": 30
    },
    {
      "name": "Juli",
      "abbreviation": "Jul",
      "number": 7,
      "days": 31
    },
    {
      "name": "Agustus",
      "abbreviation": "Aug",
      "number": 8,
      "days": 31
    },
    {
      "name": "September",
      "abbreviation": "Sep",
      "number": 9,
      "days": 30
    },
    {
      "name": "Oktober",
      "abbreviation": "Oct",
      "number": 10,
      "days": 31
    },
    {
      "name": "November",
      "abbreviation": "Nov",
      "number": 11,
      "days": 30
    },
    {
      "name": "Desember",
      "abbreviation": "Dec",
      "number": 12,
      "days": 31
    }
  ];


  let slideup = useRef<LibSlidingup>(null)
  const [resApi, setResApi] = React.useState<any>([])
  const allMonth = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
  const strBulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']

  const [SelectMonth, setSelectMonth] = useSafeState(allMonth[today.getMonth()])

  const [SelectWeek, setSelectWeek] = useSafeState(weekNumberInMonth)
  const [strSelectWeek, setStrSelectWeek] = useSafeState('')


  const [activeWeek, setActiveWeek] = useState<number | null>(null);

  const handlePress = (weeknum: number) => {
    setActiveWeek(weeknum === activeWeek ? null : weeknum);
    // console.log('weeknum', weeknum)
    // console.log('activeWeek', activeWeek)

    setSelectWeek(weeknum)
    // setFinalWeek(weekke)


  };


  function elevation(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: "black", shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
    }
    return { elevation: value };
  }
  function shadows(value: number) {
    return {
      elevation: 3, // For Android
      shadowColor: 'black', // For iOS
      shadowOffset: { width: 2, height: 5 },
      shadowOpacity: 0.9,
      shadowRadius: value,
    }
  }

  useEffect(() => {
    console.log('Attendance Report')
    // console.log('http://api.test.school.esoftplay.com/teacher_schedule_report?day=&week=&month&class_id&course_id')
    console.log('teacher_schedule_report?&month=' + SelectMonth)
    new LibCurl('teacher_schedule_report?&month=' + SelectMonth, null, (result) => {
      console.log('result', result)
      setResApi(result)
    }, (err) => {
      setResApi(resApi.schedule_days = [])
      console.log('err', err)
    })
  }, [])

  const filterApi = (month: number, week: number) => {
    // console.log('ini bulan ', month)

    if (activeWeek && month && week) {
      console.log('filter bulan ', month, ' dan minggu', week)
      // console.log('teacher_schedule_report?&week=' + week)
      new LibCurl('teacher_schedule_report?&week=' + week, null, (result) => {
        console.log('result', JSON.stringify(result))
        setResApi(result)
      }, (err) => {
        setResApi(resApi.schedule_days = [])
        console.log("error", err)
      })
    } else {
      console.log('filter bulan', month)
        , setStrSelectWeek('')
      console.log('teacher_schedule_report?&month=' + month)
      new LibCurl('teacher_schedule_report?&month=' + month, null, (result) => {
        console.log('result', JSON.stringify(result))
        setResApi(result)
      }, (err) => {
        setResApi(resApi.schedule_days = [])
        console.log("error", err)
      })
    }
  }

  const school = new SchoolColors();
  const BACKGROUND_STROKE_COLOR = '#ffffff'
  const STROKE_COLOR = '#11b81f'
  const R = 30
  const Circle_length = 2 * Math.PI * R

  return (
    <View style={{ flex: 1, backgroundColor: 'white', }}>

      <FlatList data={resApi.schedule_days}
        style={{ height: 'auto', paddingHorizontal: 20 }}
        showsVerticalScrollIndicator={false}
        ListHeaderComponent={

          <View style={{ marginBottom: 20, }}>
            {/* schadule */}
            <Text style={{ fontSize: 24, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Laporan Presensi</Text>
            <Pressable

              onPress={() => {
                slideup.current?.show()
                // console.log('')
              }}
              style={{ width: LibStyle.width - 45, height: 60, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', alignSelf: 'center', marginTop: 30, ...elevation(7), paddingHorizontal: 20, marginHorizontal: 5 }}>
              <View style={{ flexDirection: 'row', paddingHorizontal: 20 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', textAlign: 'center', }}>{strBulan[SelectMonth - 1].toUpperCase()} {strSelectWeek} </Text>
                <LibIcon.Feather name="filter" size={20} color="black" style={{ position: 'absolute', right: 20 }} />
              </View>
            </Pressable>
          </View>

        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item }) => {

            // console.log('item', item)
            // console.log('schadule finish /schadule total',   item.schedule_finished,'/',item.schedule_total )
            return (

              <Pressable onPress={() => LibNavigation.navigate('teacher/attendreport_detail', { data: item?.schedule, date: item?.date, unfinishedSchadule: (item.schedule_total - item.schedule_finished) })}
                style={{ backgroundColor: '#008000bd', padding: 10, width: LibStyle.width - 40, paddingHorizontal: 10, borderRadius: 15, opacity: 0.8, ...shadows(3), marginVertical: 5, flexDirection: 'row', justifyContent: 'space-around', alignItems: 'center', paddingVertical: 10 }}>

                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{moment(item?.date).format('dddd, DD MMMM YYYY')}</Text>
                  <View style={{flex:1}}/>
                  <Svg width={80} height={80} style={{ justifyContent: 'center', alignItems: 'center' }}>
                    {/* Lingkaran luar untuk indikator persentase  */}
                    <Circle
                      cx={80 / 2}
                      cy={80 / 2}
                      r={R}
                      fillOpacity={0.8}
                      stroke={BACKGROUND_STROKE_COLOR}
                      strokeWidth={18}
                      fill={'none'}

                    />
                    {/* Lingkaran dalam untuk menunjukkan persentase */}
                    <Circle
                      cx={80 / 2}
                      cy={80 / 2}
                      r={R}
                      // strokeOpacity={0.8}
                      stroke={STROKE_COLOR}
                      strokeWidth={12}

                      fill={'none'}
                      // fillOpacity={0.8}
                      strokeDasharray={`${Circle_length}`}

                      strokeDashoffset={Circle_length * (1 - item.schedule_finished / item.schedule_total)}
                      strokeLinecap="round"
                    />
                    <View style={{ position: 'absolute', top: 30, left: 30, justifyContent: 'center', alignItems: 'center' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.schedule_finished}/{item.schedule_total}</Text>
                    </View>
                  </Svg>
              
              </Pressable>
            )
          }
        } />

      <LibSlidingup ref={slideup}>
        <View style={{ height: "auto", backgroundColor: 'white', padding: 10, borderTopRightRadius: 20, borderTopLeftRadius: 20, paddingHorizontal: 20 }}>
          <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 20, alignSelf: 'center' }}>Filter Absensi</Text>
          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Pilih bulan</Text>
          <FlatList data={Bulan}

            keyExtractor={(item, index) => index.toString()}
            horizontal
            contentContainerStyle={{ marginTop: 10, height: 60 }}
            ListHeaderComponent={
              <View></View>
            }
            showsHorizontalScrollIndicator={false}
            renderItem={
              ({ item, index }) => {
                return (
                  <Pressable onPress={() => { setSelectMonth(allMonth[index]) }}>
                    <View style={{ flexDirection: 'row', justifyContent: 'center', marginRight: 10, height: 40, borderRadius: 12, borderWidth: 2, width: 'auto', paddingHorizontal: 10, alignItems: 'center', backgroundColor: item['number'] == SelectMonth ? school.primary : 'white', borderColor: item['number'] == SelectMonth ? school.primary : 'gray' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: item['number'] == SelectMonth ? 'white' : school.primary, alignSelf: 'center' }}>{item['name']}</Text>
                      <View style={{ height: 30 }} />
                    </View>
                  </Pressable>
                )
              }}
          />
          <ScrollView horizontal={true} showsHorizontalScrollIndicator={false} >
            <View style={{ width: '100%', height: 45, flexDirection: 'row', justifyContent: 'center', paddingHorizontal: 20 }}>
              <Pressable onPress={() => { handlePress(1,), setStrSelectWeek('Minggu  Ke ' + 1) }} style={{ width: '25%', height: 40, backgroundColor: 1 == activeWeek ? school.primary : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 1 == activeWeek ? 'white' : school.primary, borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 1 == activeWeek ? 'white' : school.primary, textAlign: 'center', }}>Minggu 1</Text>
              </Pressable>
              <Pressable onPress={() => { handlePress(2,), setStrSelectWeek('Minggu  Ke ' + 2) }} style={{ width: '25%', height: 40, backgroundColor: 2 == activeWeek ? school.primary : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 2 == activeWeek ? 'white' : school.primary, borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 2 == activeWeek ? 'white' : school.primary, textAlign: 'center', }}>Minggu 2</Text>
              </Pressable>
              <Pressable onPress={() => { handlePress(3,), setStrSelectWeek('Minggu  Ke ' + 3) }} style={{ width: '25%', height: 40, backgroundColor: 3 == activeWeek ? school.primary : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 3 == activeWeek ? 'white' : school.primary, borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 3 == activeWeek ? 'white' : school.primary, textAlign: 'center', }}>Minggu 3</Text>
              </Pressable>
              <Pressable onPress={() => { handlePress(4,), setStrSelectWeek('Minggu  Ke ' + 4) }} style={{ width: '25%', height: 40, backgroundColor: 4 == activeWeek ? school.primary : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 4 == activeWeek ? 'white' : school.primary, borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 4 == activeWeek ? 'white' : school.primary, textAlign: 'center', }}>Minggu 4</Text>
              </Pressable>
            </View>
          </ScrollView >

          < Pressable onPress={() => {
            const weekInMonth = SelectWeek; // Minggu kedua dalam bulan
            // console.log('select week', SelectWeek)
            // console.log(`Minggu ke-${weekInMonth} dalam bulan ${SelectMonth} tahun ${year} adalah minggu ke-${weekInYear} dalam tahun ini`);

            filterApi(SelectMonth, weekInMonth)
            slideup.current?.hide()
            console.log('resApi', resApi?.schedule_days ?? [])
            console.log('select month', SelectMonth)

          }
          } style={{ width: "100%", height: 60, backgroundColor: school.primary, borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginTop: 20, }}>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center', }}>Terapkan</Text>
          </Pressable >
          <View style={{ height: 20 }} />

        </View >

      </LibSlidingup >
    </View >

  )
}