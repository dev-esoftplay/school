// withHooks
import { useEffect, useRef, useState } from 'react';

import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { MaterialIcons, FontAwesome5 } from '@expo/vector-icons';
import React from 'react';
import { FlatList, Image, Linking, Platform, Pressable, Text, TouchableOpacity, View, } from 'react-native';
import { ScrollView } from 'react-native-gesture-handler';
import Svg, { Circle } from 'react-native-svg';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import { Feather } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { LibList } from 'esoftplay/cache/lib/list/import';
import esp from 'esoftplay/esp';
import useSafeState from 'esoftplay/state';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';


export interface ChildDetailArgs {

}
export interface ChildDetailProps {

}

function m(props: ChildDetailProps): any {
  const allMonths = [
    {
      "name": "January",
      "abbreviation": "Jan",
      "number": 1,
      "days": 31
    },
    {
      "name": "February",
      "abbreviation": "Feb",
      "number": 2,
      "days": 28
    },
    {
      "name": "March",
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
      "name": "May",
      "abbreviation": "May",
      "number": 5,
      "days": 31
    },
    {
      "name": "June",
      "abbreviation": "Jun",
      "number": 6,
      "days": 30
    },
    {
      "name": "July",
      "abbreviation": "Jul",
      "number": 7,
      "days": 31
    },
    {
      "name": "August",
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
      "name": "October",
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
      "name": "December",
      "abbreviation": "Dec",
      "number": 12,
      "days": 31
    }
  ]

  const allWeeks = [
    {
      "name": "Week 1",
      "number": 1,
    },
    {
      "name": "Week 2",
      "number": 2,
    },
    {
      "name": "Week 3",
      "number": 3,
    },
    {
      "name": "Week 4",
      "number": 4,
    },
  ];

  const _allMonth = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

  const allDays = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad'];



  const [weekOne, setWeekOne] = useSafeState(0)
  const [weekTwo, setWeekTwo] = useSafeState(0)
  const [weekThree, setWeekThree] = useSafeState(0)
  const [weekFour, setWeekFour] = useSafeState(0)
  const [finalWeek, setFinalWeek] = useSafeState(0)

  const today = new Date();

  const [selectedMonth, setSelectedMonth] = useState(allMonths[today.getMonth()]);
  const [selectedWeek, setSelectedWeek] = useState(allWeeks[today.getMonth()]);
  const [SelectMonth, setSelectMonth] = useSafeState(_allMonth[today.getMonth()])
  const [selectedDay, setSelectedDay] = useSafeState(allDays[today.getDay()]);

  function elevation(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: 'black', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
    }
    return { elevation: value };
  }

  const R = 30
  const Circle_length = 2 * Math.PI * R

  const idclass: string = LibNavigation.getArgsAll(props).class_id;

  const idstudent: string = LibNavigation.getArgsAll(props).student_id;

  const getWeekNumber = () => {
    // Buat objek tanggal untuk tanggal hari ini
    const today = new Date();
    const firstDayOfYear = new Date(today.getFullYear(), 0, 1);

    // Hitung selisih antara tanggal hari ini dengan tanggal 1 Januari
    const pastDays = (today.getTime() - firstDayOfYear.getTime()) / 86400000;

    // Ambil minggu keberapa dengan membagi selisih hari dengan 7
    return Math.ceil((pastDays + firstDayOfYear.getDay() + 1) / 7);
  };

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

  const [SelectWeek, setSelectWeek] = useSafeState(weekNumberInMonth)


  const handlePress = (weeknum: number, weekke: number) => {
    setActiveWeek(weeknum === activeWeek ? null : weeknum);
    // console.log('weeknum', weeknum)
    // console.log('activeWeek', activeWeek)

    setSelectWeek(weeknum), setFinalWeek(weekke)


  };

  const weeksNumber = getWeekNumber();

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

  const getDay = (date: string) => {
    switch (date) {
      case "0":
        return "Minggu"
      case "1":
        return "Senin"
      case "2":
        return "Selasa"
      case "3":
        return "Rabu"
      case "4":
        return "Kamis"
      case "5":
        return "Jumat"
      case "6":
        return "Sabtu"
      default:
        return "Minggu"
    }
  }
  // const [weekOne, setWeekOne] = useSafeState(0)
  // const [weekTwo, setWeekTwo] = useSafeState(0)
  // const [weekThree, setWeekThree] = useSafeState(0)
  // const [weekFour, setWeekFour] = useSafeState(0)
  // const [finalWeek, setFinalWeek] = useSafeState(0)


  // const getWeeksInMonth = (year: number, month: number): number[] => {
  //   const weeks: number[] = [];
  //   const firstDayOfMonth = new Date(year, month, 1);
  //   const lastDayOfMonth = new Date(year, month + 1, 0);
  //   const daysInMonth = lastDayOfMonth.getDate();
  //   const firstDayOfWeek = firstDayOfMonth.getDay();
  //   const daysBeforeFirstSunday = (7 - firstDayOfWeek) % 7;
  //   const daysFromFirstSunday = daysInMonth - daysBeforeFirstSunday;
  //   const weeksCount = Math.ceil(daysFromFirstSunday / 7);

  //   for (let i = 0; i < weeksCount; i++) {
  //     weeks.push(i + 1);
  //   }

  //   return weeks;
  // };

  // function getWeekInYear(year: number, month: number, weekInMonth: number): number {
  //   const firstDayOfMonth = new Date(year, month, 1);
  //   const firstWeekDay = firstDayOfMonth.getDay();
  //   const daysToAdd = (7 * (weekInMonth)) - firstWeekDay;
  //   const targetWeekDate = new Date(firstDayOfMonth.getTime() + daysToAdd * 86400000);
  //   const weekOfYear = Math.ceil((targetWeekDate.getTime() - new Date(year, 0, 1).getTime()) / 604800000);
  //   return weekOfYear + 1;
  // }

  let slideup = useRef<LibSlidingup>(null)

  // const allMonth = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
  // const [CurrentMonth, setCurrentMonth] = useSafeState(allMonth[today.getMonth()])
  // const [SelectMonth, setSelectMonth] = useSafeState(allMonth[today.getMonth()])
  // const [SelectWeek, setSelectWeek] = useSafeState(weekNumberInMonth)
  const [activeWeek, setActiveWeek] = useState<number | null>(null);

  // const handlePress = (weeknum: number, weekke: number) => {
  //   setActiveWeek(weeknum === activeWeek ? null : weeknum);
  //   setSelectWeek(weeknum), setFinalWeek(weekke)
  // };

  const allTabs = ['Riwayat Absensi', 'Jadwal Anak'];
  const [selectTab, setSelectTab] = useSafeState(allTabs[0])

  const [ParentStudent, setParentStudent] = useSafeState<any>([])
  const [StudentDetailAttendance, setStudentDetailAttendance] = useSafeState<any>([])
  const [TeacherScheduleClass, setTeacherScheduleClass] = useSafeState<any>([])

  const id: number = 1

  const hitApi = () => { }

  let schedule = "schedule"
  // let filterSchedule = TeacherScheduleClass?.filter((item: any) => item.schedule == schedule)

  const filterApi = (month: number, week: number) => {
    // console.log('ini bulan ', month)

    new LibCurl('student_detail_attendance?class_id=' + id + '&student_id=' + id + '&month=' + month + '&week=' + week, null, (result, msg) => {
      esp.log(result);
      setStudentDetailAttendance(result)
    }, (err: any) => {
      console.log("error", err)
    }, 1)
  }

  function loadParentStudent() {
    new LibCurl('parent_student', get, (result, msg) => {
      // console.log("result parent detail", JSON.stringify(result))
      setParentStudent(result)
    }, (err: any) => {
      console.log("error", err)
    }, 1)
  }

  function loadStudentDetailAttendance() {
    new LibCurl('student_detail_attendance?class_id=' + id + '&student_id=' + id, null, (result, msg) => {
      esp.log(result);
      setStudentDetailAttendance(result)
    }, (err: any) => {
      console.log("error", err)
    }, 1)
  }

  function loadTeacherScheduleClass() {
    new LibCurl('teacher_schedule_class?class_id=' + id, null, (result, msg) => {
      setTeacherScheduleClass(result)
    }, (err: any) => {
      console.log("error", err)
    }, 1)
  }



  useEffect(() => {
    loadParentStudent();
    loadStudentDetailAttendance();
    loadTeacherScheduleClass();
    new LibCurl('student_detail_attendance?class_id=' + idclass + '&student_id=' + idstudent, null, (result, msg) => {
      setStudentDetailAttendance(result)
    }, (err) => {
      // setEror(JSON.stringify(err))
      LibProgress.hide()
      setStudentDetailAttendance(null)
    })
  }, []);

  //   const filterApi = (month: number, week: number) => {
  //     // console.log('ini bulan ', month)

  //     if (activeWeek && month && week) {
  //       console.log('filter bulan', month, 'dan minggu', week)
  //       new LibCurl('teacher_schedule_report?&week=' + week, get, (result, msg) => {
  //         console.log('result', JSON.stringify(result))
  //         setTeacherScheduleClass(result)
  //       }, (err) => {
  //         setTeacherScheduleClass(TeacherScheduleClass.schedule_days = [])
  //         console.log('error', err)
  //       })
  //     } else {
  //       console.log('filter bulan', month)
  //       console.log('teacher_schedule_report?&month=' + month)
  //       new LibCurl('teacher_schedule_report?&month=' + month, get, (result, msg) => {
  //         console.log('result', JSON.stringify(result))
  //         setTeacherScheduleClass(result)
  //       }, (err) => {
  //         setTeacherScheduleClass(TeacherScheduleClass.schedule_days=[])
  //         console.log('error', err)
  //       })
  //     }
  //   }
  // }

  const Tabs = () => {
    if (selectTab == allTabs[0]) {
      return (
        <View style={{ padding: 20, alignItems: 'flex-start' }}>

          <View style={{ flexDirection: 'row', marginTop: -10 }}>
            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#0DBD5E', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.hadir}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Hadir</Text>
            </View>

            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#F6C956', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.sakit}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Sakit</Text>
            </View>

            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#0083FD', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.ijin}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Izin</Text>
            </View>

            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#FF4343', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.tidak_hadir}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Alfa</Text>
            </View>
          </View>

          <FlatList
            data={StudentDetailAttendance?.schedule_days}
            style={{ height: 'auto' }}
            showsVerticalScrollIndicator={false}
            ListHeaderComponent={

              <Pressable onPress={() => {
                slideup.current?.show();
              }} style={{ marginTop: 20, backgroundColor: '#FFFFFF', borderRadius: 10, alignItems: 'center', justifyContent: 'center', flexDirection: 'row', ...elevation(6), width: 370, height: 55 }}>
                <FontAwesome5 name='sliders-h' size={20} color='#000000' />
                <Text style={{ fontSize: 15, fontWeight: '500', color: '#000000', marginLeft: 10 }}>Filter</Text>
              </Pressable>
            }
            keyExtractor={(item, index) => index.toString()}
            renderItem={
              ({ item, index }) => {

                const widthAndHeight = 80
                const series = [70, 10, 20,]
                const sliceColor = ['#009B00', '#FFB300', '#FF3C00']

                return (
                  <View></View>

                )
              }
            }
          />


          <Text style={{ fontSize: 20, fontWeight: 'bold', marginTop: 10 }}>Riwayat Absensi</Text>

          {/* <View style={{ width: 100, backgroundColor: 'pink' }}>
            <Text>test riwayat riwayat</Text>
            <LibList
              data={TeacherScheduleClass}
              style={{ backgroundColor: 'green', padding: 1 }}
              renderItem={(items, i) => {
                console.log('resultRiwayat Absensi', items)
                return (
                  <View style={{ width: 100 }}>
                    <Text style={{ marginLeft: 10, marginTop: 5, fontSize: 22, color: '#000000' }}>{items.day.toUpperCase()}</Text>
                    <Text style={{ marginLeft: 10, marginTop: 35, fontSize: 15, color: '#000000' }}>01-02-2024</Text>
                  </View>
                )
              }} />
          </View> */}


          {
            StudentDetailAttendance?.schedule_day?.map?.((items: any, i: number) => {
              return (
                // <Pressable onPress={() => LibNavigation.navigate('teacher/detailattendreport')}>
                  <View style={{ marginBottom: 10, marginTop: 10, backgroundColor: '#0DBD5E', borderRadius: 10, alignItems: 'flex-end', ...elevation(4), width: 370, padding: 2 }}>
                    <View style={{ flexDirection: 'row', width: 360, height: 100, backgroundColor: '#FFFFFF', borderRadius: 10, justifyContent: 'space-between' }}>

                      <View>
                        <Text style={{ marginLeft: 10, marginTop: 5, fontSize: 22, color: '#000000' }}>{getDay(items?.day)}</Text>
                        <Text style={{ marginLeft: 10, marginTop: 35, fontSize: 15, color: '#000000' }}>{items.created_date}</Text>
                      </View>

                      <View style={{ height: 100, width: 100, justifyContent: 'center', alignItems: 'center' }}>

                        <Svg width={100} height={100} style={{ justifyContent: 'center', alignItems: 'center' }}>

                          <Circle
                            cx={100 / 2}
                            cy={100 / 2}
                            r={R}
                            fillOpacity={0.8}
                            stroke={'#96FDC6'}
                            strokeWidth={20}
                            fill={'none'}
                          />

                          <Circle
                            cx={100 / 2}
                            cy={100 / 2}
                            r={R}
                            fillOpacity={0.8}
                            stroke={'#0DBD5E'}
                            strokeWidth={12}

                            fill={'none'}
                            // fillOpacity={0.8}
                            strokeDasharray={`${Circle_length}`}
                            strokeDashoffset={Circle_length / 65}
                            strokeLinecap='round'
                          />
                        </Svg>

                        <Text style={{ position: 'absolute', color: '#000000' }}>8/8</Text>
                      </View>
                    </View>
                  </View>
                // </Pressable>


              )
            })
          }
        </View>

      );
    } else {
      return (
        <View>
          <Text style={{ fontSize: 20, fontWeight: 'bold', marginTop: 5, marginHorizontal: 20 }}>Jadwal anak</Text>

          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20, marginHorizontal: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allDays.map(day => (
                <TouchableOpacity
                  key={day}
                  onPress={() => setSelectedDay(day)}
                  style={{
                    padding: 10,
                    backgroundColor: selectedDay === day ? '#4B7AD6' : '#AAAAAA',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>
                  <Text style={{ color: selectedDay === day ? '#FFFFFF' : '#FFFFFF' }}>{day}</Text>
                </TouchableOpacity>
              ))}
            </ScrollView>
          </View>

          {/* <Text > d {JSON.stringify(TeacherScheduleClass)}</Text> */}


          <LibList
            data={TeacherScheduleClass?.schedules?.filter((item: any) => item.day == selectedDay)}
            renderItem={(items, i) => {
              console.log(items)
              return (
                <View>
                  <LibList
                    data={items.schedule}
                    keyExtractor={(scheduleItem: any) => scheduleItem.schedule_id}
                    renderItem={(item: any) => (
                      console.log('schedule', schedule),
                      <View key={item.schedule_id} style={{ marginBottom: 10, backgroundColor: '#4B7AD6', borderRadius: 10, alignItems: 'flex-end', ...elevation(4), width: 370, padding: 2, alignSelf: 'center' }}>
                        <View style={{ flex: 1, justifyContent: 'space-between', flexDirection: 'row', overflow: 'hidden', width: 360, height: 100, backgroundColor: '#FFFFFF', borderRadius: 10 }}>
                          <View style={{ flexDirection: 'row' }}>
                            <View style={{ justifyContent: 'center', alignItems: 'flex-start' }}>
                              <Text style={{ fontSize: 60, color: '#4B7AD6', marginLeft: -18 }}>00</Text>
                            </View>

                            <View style={{ height: 'auto', width: 2, backgroundColor: '#4B7AD6', opacity: 0.4 }} />

                            <View>
                              <Text style={{ marginLeft: 10, marginBottom: 35, fontSize: 22, color: '#4B7AD6' }}>{item.course.name.toUpperCase()}</Text>
                              <Text style={{ marginLeft: 10, marginBottom: 35, fontSize: 15, color: '#4B7AD6' }}>{item.clock_start} - {item.clock_end}</Text>
                            </View>

                          </View>

                          <MaterialIcons name='library-books' size={100} color='#B7CAEF' style={{ marginRight: -20, marginTop: 10 }} />

                        </View>
                      </View>
                    )}
                  />

                </View>
              )
            }}
          />
        </View>
      );
    }
  }

  return (
    <View style={{ flex: 1 }}>
      <ScrollView showsVerticalScrollIndicator={false}>

        <View style={{ flex: 1, backgroundColor: '#4B7AD6', borderBottomRightRadius: 20, borderBottomLeftRadius: 20, padding: 20, paddingTop: 40 }}>

          <View style={{ backgroundColor: '#FFFFFF', height: 120, justifyContent: 'flex-start', alignItems: 'center', marginVertical: 20, padding: 15, flexDirection: 'row', borderRadius: 10 }}>
            {/* <Image source={require('../../assets/anies.png')} style={{ width: 95, height: 95, justifyContent: 'center' }} /> */}

            <View style={{ marginLeft: 15, justifyContent: 'center', alignItems: 'flex-start' }}>
              <Text style={{ fontSize: 19, color: '#000000', textAlign: 'center', fontWeight: '600' }}>{ParentStudent?.student_data?.[0]?.student_name}</Text>
              <Text style={{ fontSize: 19, color: '#000000', textAlign: 'center', fontWeight: '600' }}>{ParentStudent?.student_data?.[0]?.class_name}</Text>
              <Text style={{ fontSize: 19, color: '#000000', textAlign: 'center', fontWeight: '600' }}>{ParentStudent?.student_data?.[0]?.nis}</Text>

            </View>

          </View>

          <View style={{ flexDirection: 'row', marginVertical: 2, justifyContent: 'space-evenly' }}>
            <Pressable onPress={() => Linking.openURL('https://wa.me/+6281295822119')} style={{ flexDirection: 'row', alignItems: 'center', padding: 10, backgroundColor: '#0DBD5E', borderRadius: 12, height: 60 }}>
              <LibIcon.FontAwesome name="phone" size={30} color="white" style={{ marginLeft: 110 }} />
              <Text style={{ fontSize: 16, color: '#FFFFFF', marginRight: 110 }}>Panggil Guru</Text>
            </Pressable>

            {/* <Pressable onPress={() => LibDialog.info("Info", "Masuk Coy")} style={{ flexDirection: 'row', alignItems: 'center', padding: 20, backgroundColor: '#3F8DFD', borderRadius: 12, height: 70 }}>
              <LibIcon.FontAwesome name="user-circle" size={30} color="white" style={{ marginRight: 10 }} />
              <Text style={{ fontSize: 16, color: 'white' }}>Ijinkan Anak</Text>
            </Pressable> */}
          </View>
        </View>

        <View style={{ flexDirection: 'row', margin: 20, justifyContent: 'center' }}>

          <TouchableOpacity onPress={() => setSelectTab(allTabs[0])} key={0} style={{ paddingVertical: 15, paddingHorizontal: 5, backgroundColor: selectTab === allTabs[0] ? '#4B7AD6' : '#FFFFFF', justifyContent: 'center', alignItems: 'center', marginLeft: 15, ...elevation(6), width: LibStyle.width * 0.5 - 25, borderBottomLeftRadius: 10, borderTopLeftRadius: 10 }}>
            <Text style={{ color: selectTab === allTabs[0] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[0]}</Text>
          </TouchableOpacity>

          <TouchableOpacity onPress={() => setSelectTab(allTabs[1])} key={1} style={{ paddingVertical: 15, paddingHorizontal: 32, backgroundColor: selectTab === allTabs[1] ? '#4B7AD6' : '#FFFFFF', justifyContent: 'center', alignItems: 'center', marginRight: 15, ...elevation(6), width: LibStyle.width * 0.5 - 25, borderBottomRightRadius: 10, borderTopRightRadius: 10 }}>
            <Text style={{ color: selectTab === allTabs[1] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[1]}</Text>
          </TouchableOpacity>
        </View>


        <Tabs />

      </ScrollView>

      <LibSlidingup ref={slideup}>
        <View style={{ height: 410, backgroundColor: 'white', padding: 10, borderTopRightRadius: 20, borderTopLeftRadius: 20, paddingHorizontal: 20 }}>

          <TouchableOpacity onPress={() => { slideup.current?.hide() }} style={{ alignItems: 'flex-end' }}>
            <Feather name='x' size={35} color={'#000000'} />
          </TouchableOpacity>

          <View>
            <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 10, alignSelf: 'center' }}>Filter Kehadiran</Text>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Pilih Bulan</Text>
          </View>

          <FlatList data={allMonths}

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
                  <Pressable onPress={() => { setSelectedMonth(item) }}>
                    <View style={{ flexDirection: 'row', justifyContent: 'center', marginRight: 10, height: 40, borderRadius: 12, borderWidth: 2, width: 'auto', paddingHorizontal: 10, alignItems: 'center', backgroundColor: item?.name == selectedMonth?.name ? '#4B7AD6' : '#FFFFFF', borderColor: item?.name == selectedMonth?.name ? '#4B7AD6' : '#4B7AD6' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: item?.name == selectedMonth?.name ? 'white' : '#4B7AD6', alignSelf: 'center' }}>{item['name']}</Text>
                      <View style={{ height: 30 }} />
                    </View>
                  </Pressable>
                )
              }}
          />


          {/* <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allMonths.map(month => (
                <TouchableOpacity
                  onPress={() => setSelectedMonth(month)}
                  style={{
                    padding: 10,
                    backgroundColor: selectedMonth?.number == month?.number ? '#4B7AD6' : '#AAAAAA',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>

                  <Text style={{ color: selectedMonth === month ? '#FFFFFF' : '#FFFFFF' }}>{month.name}</Text>

                </TouchableOpacity>
              ))}
            </ScrollView>
          </View> */}

          <View>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: '#000000', marginTop: 5 }}>Pilih Minggu</Text>
          </View>

          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false} >
              <View style={{ width: '100%', height: 45, flexDirection: 'row', justifyContent: 'center', paddingHorizontal: 20 }}>
                <Pressable onPress={() => { console.log('minggu 1:', weekOne,), handlePress(1, weekOne) }} style={{ width: '25%', height: 40, backgroundColor: 1 == activeWeek ? '#4B7AD6' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 1 == activeWeek ? '#FFFFFF' : '#4B7AD6', borderWidth: 2 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 1 == activeWeek ? '#FFFFFF' : '#4B7AD6', textAlign: 'center', }}>Minggu 1</Text>
                </Pressable>
                <Pressable onPress={() => { console.log('minggu 2:', weekTwo,), handlePress(2, weekTwo) }} style={{ width: '25%', height: 40, backgroundColor: 2 == activeWeek ? '#4B7AD6' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 2 == activeWeek ? '#FFFFFF' : '#4B7AD6', borderWidth: 2 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 2 == activeWeek ? '#FFFFFF' : '#4B7AD6', textAlign: 'center', }}>Minggu 2</Text>
                </Pressable>
                <Pressable onPress={() => { console.log('minggu 3:', weekThree,), handlePress(3, weekThree) }} style={{ width: '25%', height: 40, backgroundColor: 3 == activeWeek ? '#4B7AD6' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 3 == activeWeek ? '#FFFFFF' : '#4B7AD6', borderWidth: 2 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 3 == activeWeek ? '#FFFFFF' : '#4B7AD6', textAlign: 'center', }}>Minggu 3</Text>
                </Pressable>
                <Pressable onPress={() => { console.log('minggu 4:', weekFour,), handlePress(4, weekFour) }} style={{ width: '25%', height: 40, backgroundColor: 4 == activeWeek ? '#4B7AD6' : 'white', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginHorizontal: 5, borderColor: 4 == activeWeek ? '#FFFFFF' : '#4B7AD6', borderWidth: 2 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 4 == activeWeek ? '#FFFFFF' : '#4B7AD6', textAlign: 'center', }}>Minggu 4</Text>
                </Pressable>
              </View >
            </ScrollView >
          </View>

          <TouchableOpacity onPress={() => {
            slideup.current?.hide()

            const year = 2024;
            const month = SelectMonth - 1; // Januari (index dimulai dari 0)
            const weekInMonth = SelectWeek; // Minggu kedua dalam bulan
            // console.log('select week', SelectWeek)
            let weekInYear = getWeekInYear(year, month, weekInMonth);

            filterApi(selectedMonth?.number, weekInYear)
          }} style={{ width: "100%", height: 50, backgroundColor: '#4B7AD6', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginTop: 35 }}>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center' }}>Terapkan</Text>
          </TouchableOpacity>

        </View>
      </LibSlidingup>
    </View>
  )
}
export default memo(m);

{/* <View key={index} style={{ marginBottom: 10, backgroundColor: '#4B7AD6', borderRadius: 10, alignItems: 'flex-end', ...elevation(4), width: 350, padding: 2 }}>
<View style={{width: 340, height: 100, backgroundColor: '#FFFFFF', ...elevation(4), borderRadius: 10 }}>
 
  
  
  <View style={{ marginTop: -15, justifyContent: 'center', alignItems: 'flex-start'  }}>
  <Text style={{ fontSize: 60, color:'#4B7AD6' }}>00</Text>
  </View>

  <View style={{}}>
  <Text style={{fontSize: 22, color: '#4B7AD6' }}>{event}</Text>
  <Text style={{ fontSize: 15, color: '#4B7AD6' }}>00:00 - 00:00</Text>
  </View>

  <View style={{ alignSelf: 'flex-end', marginTop: -90}}>
    <MaterialIcons name='library-books' size={100} color='#B7CAEF' />
  </View>

</View>
</View> */}


