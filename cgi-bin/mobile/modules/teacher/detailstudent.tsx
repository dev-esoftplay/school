// withHooks
import { memo } from 'react';

import { useEffect, useRef, useState } from 'react';

import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import useSafeState from 'esoftplay/state';
import React from 'react';
import { FlatList, Linking, Platform, Pressable, Text, View } from 'react-native';
import { ScrollView } from 'react-native-gesture-handler';
import moment from 'esoftplay/moment';
import { LibStyle } from 'esoftplay/cache/lib/style/import';


export interface TeacherDetailStudentArgs {

}
export interface TeacherDetailStudentProps {

}
function m(props: TeacherDetailStudentProps): any {
  function shadowS(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 }
    }
    return { elevation: value };
  }
  let slideup = useRef<LibSlidingup>(null)

  let [Eror, setEror] = useState("")


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
  const strBulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']
  const idclass: string = LibNavigation.getArgsAll(props).class_id;
  const idstudent: string = LibNavigation.getArgsAll(props).student_id;
  const dataParent: any = LibNavigation.getArgsAll(props).parent;
  const studentName: string = LibNavigation.getArgsAll(props).studentName;
  const data: any = LibNavigation.getArgsAll(props).data;
  const className: string = LibNavigation.getArgsAll(props).className;


  const today = new Date();
  // className:resApi2.class_name,
  // dadName:item.parent.dad.name,
  // dadPhone:item.parent.dad.phone,
  const [resApi, setResApi] = useState<any>([])

  const getWeekNumber = () => {
    // Buat objek tanggal untuk tanggal hari ini
    const today = new Date();
    const firstDayOfYear = new Date(today.getFullYear(), 0, 1);

    // Hitung selisih antara tanggal hari ini dengan tanggal 1 Januari
    const pastDays = (today.getTime() - firstDayOfYear.getTime()) / 86400000;

    // Ambil minggu keberapa dengan membagi selisih hari dengan 7
    return Math.ceil((pastDays + firstDayOfYear.getDay() + 1) / 7);
  };

  // Gunakan fungsi getWeekNumber untuk mendapatkan minggu keberapa dalam tahun ini
  const weeksNumber = getWeekNumber();


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
  const [finalWeek, setFinalWeek] = useSafeState()

  ///



  const WeekOneInThisMonth = (weekNumber: number) => {
    switch (weekNumber) {
      case 1:
        return setWeekOne(weeksNumber)
      case 2:
        return setWeekOne(weeksNumber - 1)
      case 3:
        return setWeekOne(weeksNumber - 2)
      case 4:
        return setWeekOne(weeksNumber - 3)
    }
  }
  const WeekTwoInThisMonth = (weekNumber: number) => {
    switch (weekNumber) {
      case 1:
        return setWeekTwo(weeksNumber + 1), console.log(weeksNumber + 1)
      case 2:
        return setWeekTwo(weeksNumber)
      case 3:
        return setWeekTwo(weeksNumber - 1)
      case 4:
        return setWeekTwo(weeksNumber - 2)
    }
  }
  const WeekThreeInThisMonth = (weekNumber: number) => {
    switch (weekNumber) {
      case 1:
        return setWeekThree(weeksNumber + 2)
      case 2:
        return setWeekThree(weeksNumber + 1)
      case 3:
        return setWeekThree(weeksNumber)
      case 4:
        return setWeekThree(weeksNumber - 1)
    }
  }
  const WeekFourInThisMonth = (weekNumber: number) => {
    switch (weekNumber) {
      case 1:
        return setWeekFour(weeksNumber + 3)
      case 2:
        return setWeekFour(weeksNumber + 2)
      case 3:
        return setWeekFour(weeksNumber + 1)
      case 4:
        return setWeekFour(weeksNumber)
    }
  }
  const allMonth = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
  // const [CurentMonth, setCurentMonth] = useSafeState(allMonth[today.getMonth()])
  const [SelectMonth, setSelectMonth] = useSafeState(allMonth[today.getMonth()])

  const [SelectWeek, setSelectWeek] = useSafeState(weekNumberInMonth)



  const [activeWeek, setActiveWeek] = useState<number | null>(null);

  const handlePress = (weeknum: number, weekke: number) => {
    setActiveWeek(weeknum === activeWeek ? null : weeknum);
    // console.log('weeknum', weeknum)
    // console.log('activeWeek', activeWeek)

    setSelectWeek(weeknum), setFinalWeek(weeknum)


  };


  ///

  function getWeekInYear(year: number, month: number, weekInMonth: number): number {
    // Mendapatkan tanggal pertama dalam bulan
    const firstDayOfMonth = new Date(year, month, 1);

    // Mendapatkan hari pertama dalam minggu pertama
    const firstWeekDay = firstDayOfMonth.getDay(); // Minggu dimulai dari hari ke-0 (Minggu)

    // Menghitung hari yang dibutuhkan untuk mencapai minggu yang dimaksud
    const daysToAdd = (7 * (weekInMonth - 1)) - firstWeekDay;

    // Menciptakan tanggal pada minggu yang dimaksud
    const targetWeekDate = new Date(firstDayOfMonth.getTime() + daysToAdd * 86400000); // 86400000 milidetik dalam sehari

    // Mendapatkan minggu keberapa dalam tahun itu jatuh
    const weekOfYear = Math.ceil((targetWeekDate.getTime() - new Date(year, 0, 1).getTime()) / 604800000); // 604800000 milidetik dalam seminggu

    return weekOfYear + 1;
  }


  ///
  useEffect(() => {
    LibProgress.show('loading')
    // console.log("idclass", idclass, typeof idclass)
    // console.log("idstudent", idstudent, typeof idstudent)
    // Gunakan fungsi getWeekNumber untuk mendapatkan minggu keberapa dalam tahun ini
    // console.log('ini bulan ', CurentMonth)
    // console.log("Minggu ke- ", weekNumberInMonth, 'dalam bulan ini');
    // console.log('ini minggu ke', weeksNumber, 'dalam tahun ini')
    WeekOneInThisMonth(weekNumberInMonth)
    WeekTwoInThisMonth(weekNumberInMonth)
    WeekThreeInThisMonth(weekNumberInMonth)
    WeekFourInThisMonth(weekNumberInMonth)
    setFinalWeek(weekNumberInMonth)
    // console.log('select week', SelectWeek)

    // console.log('url', url)
    //http://api.test.school.esoftplay.com/student_detail_attendance?class_id=1&student_id=1&month=2&week=6
    new LibCurl('student_detail_attendance?class_id=' + idclass + '&student_id=' + idstudent, null, (result) => {
      // console.log("result detail siswa", result)
      // console.log("msg detail siswa", msg)
      LibProgress.hide()
      setResApi(result)
    }, (err) => {
      setEror(JSON.stringify(err))
      // console.log("error", err)
      // console.log("error", JSON.stringify(err))
      LibProgress.hide()
      setResApi(null)
    })


  }, [])


  const filterApi = (month: number, week: number) => {
    // console.log('ini bulan ', month)

    if (activeWeek && month && week) {
      // console.log('filter bulan dan minggu', month, week)
      new LibCurl('student_detail_attendance?class_id=' + idclass + '&student_id=' + idstudent + '&month=' + month + '&week=' + week, null, (result) => {
        // console.log('student_detail_attendance?class_id=' + idclass + '&student_id=' + idstudent + '&month=' + month + '&week=' + week,)
        // console.log("result detail siswa", result)
        setResApi(result)
      }, () => {
        // console.log("error", err)
      })
    } else {
      // console.log('filter bulan', month)
      new LibCurl('student_detail_attendance?class_id=' + idclass + '&student_id=' + idstudent + '&month=' + month, null, (result) => {
        // console.log('student_detail_attendance?class_id=' + idclass + '&student_id=' + idstudent + '&month=' + month)
        // console.log("result detail siswa", result)
        setResApi(result)
      }, () => {
        // console.log("error", err)
      })
    }
  }






  if (resApi == null) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>Tidak ada data</Text>
        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{Eror}</Text>
        <Pressable onPress={() => { LibNavigation.back() }} style={{ width: 100, height: 40, backgroundColor: 'green', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginTop: 20 }}>
          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Kembali</Text>
        </Pressable>
      </View>
    )
  }

  return (
    <View style={{ flex: 1 }}>
      <ScrollView style={{ flex: 1, paddingHorizontal: 20, marginBottom: 30, marginTop: LibStyle.STATUSBAR_HEIGHT }}>
        <Pressable onPress={() => { LibNavigation.back() }} style={{ height: 40, justifyContent: 'flex-start', }}>
          <View style={{ flexDirection: 'row', alignItems: 'center' ,justifyContent:'flex-start'}}>
            <LibIcon.EntypoIcons name='chevron-left' size={35} color='gray' />
            <Text style={{ fontSize: 20, fontWeight: 'bold', }}>Detail Siswa</Text>
          </View>
        </Pressable>
        {/* CARD DETAIL SISWA */}
        {/* JANGAN LUPA DIBUAT LIST DENGAN DATAPARENT */}

        <View style={{ flexDirection: 'row', alignItems: 'center', paddingHorizontal: 20, paddingVertical: 20, backgroundColor: 'white', borderRadius: 10, marginTop: 5, padding: 10, ...shadowS(5), margin: 5, }}>
          <View style={{ width: 100, height: 100, borderRadius: 50, backgroundColor: '#dfd9d9', justifyContent: 'center', alignItems: 'center' }}>
            <LibIcon.AntDesign name='user' size={45} color='gray' />
          </View>
          <View style={{ marginLeft: 10 }}>
            <Text style={{ fontSize: 16, fontWeight: 'bold' }}>{studentName ?? 'nama'}</Text>
            <Text style={{ fontSize: 16 }}>No Abesen {data.number ?? '0'}</Text>
            <Text style={{ fontSize: 16 }}>{className ?? 'kelas '} </Text>
          </View>

        </View>

        <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Kontak Wali Murid</Text>
        <FlatList data={dataParent}
          keyExtractor={(item, index) => index.toString()}
          horizontal={true}
          showsHorizontalScrollIndicator={false}
          contentContainerStyle={{ marginVertical: 20, height: 'auto' }}
          renderItem={
            ({ item }) => {
              // console.log('item', item)
              return (
                <View style={{ flex: 1, backgroundColor: 'white', borderRadius: 10, marginTop: 5, padding: 10, ...shadowS(5), margin: 5, width: 200 }}>
                  {/* Row Detail siswa */}
                  <View style={{ flexDirection: 'row', alignItems: 'center', paddingHorizontal: 20, paddingTop: 20 }}>
                    {/* <View style={{ width: 100, height: 100, borderRadius: 50, backgroundColor: '#dfd9d9', justifyContent: 'center', alignItems: 'center' }}>
                    <LibIcon.AntDesign name='user' size={45} color='gray' />
                  </View> */}

                    <View style={{ marginLeft: 10 }}>
                      <Text style={{ fontSize: 16, fontWeight: 'bold' }}>{item.name}</Text>
                      <Text style={{ fontSize: 16 }}>Status {item.status ?? ""}</Text>
                      {/* <Text style={{ fontSize: 16 }}>+{item.phone ?? "097970"} </Text> */}
                    </View>
                  </View>

                  {/* Button wa orang tua */}

                  {/* WeekTwoInThisMonth(1), // console.log('minggu 2:', weekTwo, 'minggu ke', weekTwo, 'dalam tahun ini') */}
                  <Pressable onPress={() => { console.log('https://wa.me/' + item.phone, Linking.openURL('https://wa.me/' + item.phone)) }} style={{ width: '90%', height: 60, backgroundColor: '#32b100', borderRadius: 10, justifyContent: 'center', alignSelf: 'center', marginVertical: 10, ...shadowS(7), paddingHorizontal: 20, marginHorizontal: 10, }}>
                    <View style={{ flexDirection: 'row', paddingHorizontal: 20 }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: '#ffffff', textAlign: 'center', }}>Hubungi</Text>
                      {/* <FontAwesome name="whatsapp" size={24} color="black" /> */}
                      <LibIcon.FontAwesome name="whatsapp" size={24} color="#ffffff" style={{ marginLeft: 10 }} />
                    </View>
                  </Pressable>


                </View>
              )
            }
          } />
        {/* CARD JADWAL */}

        <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 15 }}>Absensi siswa </Text>

        {/* CARD ABSENSI */}
        {/* <View style={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 20 }}> 

          <View style={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 10 }}>
            <View style={{ width: 75, height: 70, backgroundColor: "green", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.hadir ?? "0"}</Text>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Hadir</Text>
            </View>
            <View style={{ width: 75, height: 70, backgroundColor: "orange", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.sakit ?? "0"}</Text>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Sakit</Text>
            </View>
            <View style={{ width: 75, height: 70, backgroundColor: "#0083fd", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.ijin ?? "0"}</Text>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Ijin</Text>
            </View>
            <View style={{ width: 75, height: 70, backgroundColor: "red", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.tidak_hadir ?? "0"}</Text>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Alpha</Text>
            </View>
          </View>

        </View> */}
        {/* button filter Slide Up */}
        <Pressable onPress={() => {
          slideup.current?.show()
          // console.log('slide up')
        }
        } style={{
          height: 50, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', alignSelf: 'center', marginVertical: 10, ...shadowS(7), width: '98%',
           marginHorizontal: 15,
        }}>
          <View style={{ flexDirection: 'row', paddingHorizontal: 20 }}>

            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', }}>{strBulan[SelectMonth-1].toUpperCase()} {activeWeek!=null || undefined?'MINGGU KE '+activeWeek:''}</Text>
            <LibIcon.Feather name="filter" size={20} color="black" style={{ position: 'absolute', right: 20 }} />
          </View>
        </Pressable>


        {/* card absensi */}
        <FlatList data={resApi.schedule_day}
          contentContainerStyle={{ paddingBottom: 20 }}

          renderItem={
            ({ item }) => {
              return (
                <Pressable onPress={() => LibNavigation.navigate('teacher/detailattendreport', {
                  data: item,
                  idstudent: idstudent,
                })} style={{ backgroundColor: '#0DBD5E', padding: 10, width: '100%', paddingHorizontal: 20, borderRadius: 15, opacity: 0.8, ...shadowS(3), marginVertical: 10, height: 80, justifyContent: 'center' }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{moment(item?.created_date).format('dddd, DD MMMM YYYY')}</Text>


                </Pressable>
              )
            }
          } />
        {/* SLIDE UP */}
      </ScrollView >
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
                    <View style={{ flexDirection: 'row', justifyContent: 'center', marginRight: 10, height: 40, borderRadius: 12, borderWidth: 2, width: 'auto', paddingHorizontal: 10, alignItems: 'center', backgroundColor: item['number'] == SelectMonth ? '#136B93' : 'white', borderColor: item['number'] == SelectMonth ? '#136B93' : 'gray' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: item['number'] == SelectMonth ? 'white' : '#136B93', alignSelf: 'center' }}>{item['name']}</Text>
                      <View style={{ height: 30 }} />
                    </View>
                  </Pressable>
                )
              }}
          />
          <ScrollView horizontal={true} showsHorizontalScrollIndicator={false} >
            <View style={{ width: '100%', height: 45, flexDirection: 'row', justifyContent: 'center', paddingHorizontal: 20 }}>
              <Pressable onPress={() => { console.log('minggu 1:', weekOne,), handlePress(1, weekOne) }} style={{ width: '25%', height: 40, backgroundColor: 1 == activeWeek ? '#136B93' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 1 == activeWeek ? 'white' : '#136B93', borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 1 == activeWeek ? 'white' : '#136B93', textAlign: 'center', }}>Minggu 1</Text>
              </Pressable>
              <Pressable onPress={() => { console.log('minggu 2:', weekTwo,), handlePress(2, weekTwo) }} style={{ width: '25%', height: 40, backgroundColor: 2 == activeWeek ? '#136B93' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 2 == activeWeek ? 'white' : '#136B93', borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 2 == activeWeek ? 'white' : '#136B93', textAlign: 'center', }}>Minggu 2</Text>
              </Pressable>
              <Pressable onPress={() => { console.log('minggu 3:', weekThree,), handlePress(3, weekThree) }} style={{ width: '25%', height: 40, backgroundColor: 3 == activeWeek ? '#136B93' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 3 == activeWeek ? 'white' : '#136B93', borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 3 == activeWeek ? 'white' : '#136B93', textAlign: 'center', }}>Minggu 3</Text>
              </Pressable>
              <Pressable onPress={() => { console.log('minggu 4:', weekFour,), handlePress(4, weekFour) }} style={{ width: '25%', height: 40, backgroundColor: 4 == activeWeek ? '#136B93' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 4 == activeWeek ? 'white' : '#136B93', borderWidth: 2 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 4 == activeWeek ? 'white' : '#136B93', textAlign: 'center', }}>Minggu 4</Text>
              </Pressable>
            </View >
          </ScrollView >
          {/* Contoh penggunaan:
          const year = 2024;
          const month = 1; // Januari (index dimulai dari 0)
          const weekInMonth = 2; // Minggu kedua dalam bulan

          let weekInYear = getWeekInYear(year, month, weekInMonth);
          ini.` */}

          < Pressable onPress={() => {
            const year = 2024;
            const month = SelectMonth - 1; // Januari (index dimulai dari 0)
            const weekInMonth = SelectWeek; // Minggu kedua dalam bulan
            // console.log('select week', SelectWeek)
            let weekInYear = getWeekInYear(year, month, weekInMonth);
            // console.log(`Minggu ke-${weekInMonth} dalam bulan ${SelectMonth} tahun ${year} adalah minggu ke-${weekInYear} dalam tahun itu`);


            filterApi(SelectMonth, weekInYear)
            slideup.current?.hide()
            console.log('select month', SelectMonth)
          }
          } style={{ width: "100%", height: 60, backgroundColor: '#136B93', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginTop: 20, }}>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center', }}>Terapkan</Text>
          </Pressable >
          <View style={{ height: 20 }} />

        </View >
      </LibSlidingup >
    </View >
  )
}


export default memo(m);